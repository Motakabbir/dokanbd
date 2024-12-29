<?php

namespace SiteMailer\Modules\Suppressions\Rest;

use SiteMailer\Modules\Suppressions\Classes\Route_Base;
use SiteMailer\Modules\Suppressions\Database\Suppressions_Entry;
use SiteMailer\Modules\Suppressions\Database\Suppressions_Table;
use Throwable;
use WP_Error;
use WP_REST_Request;
use WP_REST_Response;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class Get_Suppressions extends Route_Base {
	public string $path = 'get-suppressions';

	public function get_methods(): array {
		return [ 'GET' ];
	}

	public function get_name(): string {
		return 'get-suppressions';
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_Error|WP_REST_Response
	 *
	 * @query {
	 *     require numeric 0 < $limit < 100
	 *     require numeric $page
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

			//Set offset
			$offset = ( $params['page'] - 1 ) * $params['limit'];

			// Set limit from 1 to 100
			$limit = max( $params['limit'], 1 ) !== 1 ? min( $params['limit'], 100 ) : 1;

			// Set order/default order
			$order = $params['orderBy'] && $params['order']
				? [ '`' . $params['orderBy'] . '`' => $params['order'] ]
				: [ Suppressions_Table::CREATED_AT => 'DESC' ];

			$suppressions = Suppressions_Entry::get_suppressions(
				'*',
				'1',
				$limit,
				$offset,
				'',
				$order,
			);

			$total = Suppressions_Entry::get_suppressions_count();

			return $this->respond_success_json( [
				'items'  => $suppressions,
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
