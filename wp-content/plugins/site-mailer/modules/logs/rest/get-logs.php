<?php

namespace SiteMailer\Modules\Logs\Rest;

use SiteMailer\Modules\Logs\Classes\Route_Base;
use SiteMailer\Modules\Logs\Database\Log_Entry;
use SiteMailer\Modules\Logs\Database\Logs_Table;
use SiteMailer\Modules\Statuses\Database\Statuses_Table;
use Throwable;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Get_Logs extends Route_Base {
	public string $path = 'get-logs';

	public function get_methods(): array {
		return [ 'GET' ];
	}

	public function get_name(): string {
		return 'get-logs';
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 *
	 * @query {
	 *     require numeric 0 < $limit < 100
	 *     require numeric $page
	 *     Date $period
	 *     string $orderBy
	 *     string $order
	 * }
	 */
	public function GET( WP_REST_Request $request ) {
		try {
			$error = $this->verify_capability();

			if ( $error ) {
				return $error;
			}

			$params = $request->get_query_params();

			// Set limit from 1 to 100
			$limit = max( $params['limit'], 1 ) !== 1 ? min( $params['limit'], 100 ) : 1;

			//Set offset
			$offset = ( $params['page'] - 1 ) * $params['limit'];

			// Add period
			$where = $params['period'] ? [
				[
					'column' => Logs_Table::table_name() . '.created_at',
					'value' => $params['period'],
					'operator' => '>',
				],
			] : '1';

			// Set order/default order
			$order_by = $params['orderBy'] && $params['order']
				? [ Logs_Table::table_name() . '.' . $params['orderBy'] => $params['order'] ]
				: [ Logs_Table::table_name() . '.created_at' => 'DESC' ];

			$logs = Log_Entry::get_logs( $where, $limit, $offset, $order_by );

			$total = Log_Entry::get_logs_count( $where );

			return $this->respond_success_json( [
				'items'  => $logs,
				'total' => $total[0]->count,
			]);
		} catch ( Throwable $t ) {
			return $this->respond_error_json( [
				'message' => $t->getMessage(),
				'code' => 'internal_server_error',
			] );
		}
	}
}
