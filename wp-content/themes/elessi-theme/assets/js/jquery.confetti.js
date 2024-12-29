jQuery(document).ready(function($) {
    "use strict";
    $.confetti = new function() {
        // globals
        var canvas;
        var ctx;
        var W;
        var H;
        var mp = 300; //max particles
        var particles = [];
        var angle = 0;
        var tiltAngle = 0;
        var confettiActive = true;
        var animationComplete = true;
        var deactivationTimerHandler;
        var reactivationTimerHandler;
        var animationHandler;
        var _inited = false;

        // objects

        var particleColors = {
            // colorOptions: ["DodgerBlue", "OliveDrab", "Gold", "pink", "SlateBlue", "lightblue", "Violet", "PaleGreen", "SteelBlue", "SandyBrown", "Chocolate", "Crimson"],
            colorOptions: ["#EF2964", "#00C09D", "#2D87B0", "#48485E", "#EFFF1D"],
            colorIndex: 0,
            colorIncrementer: 0,
            colorThreshold: 10,
            getColor: function () {
                if (this.colorIncrementer >= 10) {
                    this.colorIncrementer = 0;
                    this.colorIndex++;
                    if (this.colorIndex >= this.colorOptions.length) {
                        this.colorIndex = 0;
                    }
                }
                this.colorIncrementer++;
                return this.colorOptions[this.colorIndex];
            }
        };

        function confettiParticle(color) {
            this.x = Math.random() * W; // x-coordinate
            this.y = (Math.random() * H) - H; //y-coordinate
            this.r = RandomFromTo(5, 15); //radius;
            this.d = (Math.random() * mp) + 10; //density;
            this.color = color;
            this.tilt = Math.floor(Math.random() * 10) - 10;
            this.tiltAngleIncremental = (Math.random() * 0.07) + 0.05;
            this.tiltAngle = 0;

            this.draw = function () {
                ctx.beginPath();
                ctx.lineWidth = this.r / 2;
                ctx.strokeStyle = this.color;
                ctx.moveTo(this.x + this.tilt + (this.r / 4), this.y);
                ctx.lineTo(this.x + this.tilt, this.y + this.tilt + (this.r / 4));
                return ctx.stroke();
            };
        }

        function init() {
            SetGlobals();

            $(window).on('resize', function () {
                W = window.innerWidth;
                H = window.innerHeight;
                canvas.width = W;
                canvas.height = H;
            });
        }
        
        function SetGlobals() {
            if ($('#nasa-confetti').length < 1) {
                if ($('form.nasa-shopping-cart-form').length) {
                    $('body').append('<canvas id="nasa-confetti" style="display: none;"></canvas>');
                }
                else if ($('#cart-sidebar').length) {
                    $('#cart-sidebar').append('<canvas id="nasa-confetti" style="display: none;"></canvas>');
                }
                else {
                    $('body').append('<canvas id="nasa-confetti" style="display: none;"></canvas>');
                }

                if ($('#ns-cart-popup').length) {
                    $('#ns-cart-popup').parents('.ns-cart-popup-wrap').prepend('<canvas id="nasa-confetti-popup" style="display: none; position: relative; z-index: 9;"></canvas>');
                }
            }

            if ($('#review_form_wrapper').length && $('#nasa-confetti-review').length < 1) {
                $('#review_form_wrapper').prepend('<canvas id="nasa-confetti-review" style="display: none;"></canvas>');
            }
            
            canvas = document.getElementById("nasa-confetti");
            if ($('#ns-cart-popup').parents('.ns-cart-popup-wrap').hasClass('nasa-active')) {
                canvas = document.getElementById("nasa-confetti-popup");
            }

            if ($('#review_form_wrapper').hasClass('ns-show')) {
                canvas = document.getElementById("nasa-confetti-review");
            }

            ctx = canvas.getContext("2d");
            W = window.innerWidth;
            H = window.innerHeight;
            canvas.width = W;
            canvas.height = H;
            
            _inited = true;
        }

        function InitializeConfetti() {
            canvas.style.display = 'block';
            particles = [];
            animationComplete = false;
            for (var i = 0; i < mp; i++) {
                var particleColor = particleColors.getColor();
                particles.push(new confettiParticle(particleColor));
            }
            StartConfetti();
        }

        function Draw() {

            if ($('body').hasClass('nasa-in-mobile')) {
                mp = 50;
            } else {
                mp = 300;
            }

            ctx.clearRect(0, 0, W, H);
            var results = [];
            for (var i = 0; i < mp; i++) {
                (function (j) {
                    results.push(particles[j].draw());
                })(i);
            }
            Update();

            return results;
        }

        function RandomFromTo(from, to) {
            return Math.floor(Math.random() * (to - from + 1) + from);
        }


        function Update() {
            var remainingFlakes = 0;
            var particle;
            angle += 0.01;
            tiltAngle += 0.1;

            for (var i = 0; i < mp; i++) {
                particle = particles[i];
                if (animationComplete) return;

                if (!confettiActive && particle.y < -15) {
                    particle.y = H + 100;
                    continue;
                }

                stepParticle(particle, i);

                if (particle.y <= H) {
                    remainingFlakes++;
                }
                CheckForReposition(particle, i);
            }

            if (remainingFlakes === 0) {
                StopConfetti();
            }
        }

        function CheckForReposition(particle, index) {
            if ((particle.x > W + 20 || particle.x < -20 || particle.y > H) && confettiActive) {
                if (index % 5 > 0 || index % 2 == 0) //66.67% of the flakes
                {
                    repositionParticle(particle, Math.random() * W, -10, Math.floor(Math.random() * 10) - 10);
                } else {
                    if (Math.sin(angle) > 0) {
                        //Enter from the left
                        repositionParticle(particle, -5, Math.random() * H, Math.floor(Math.random() * 10) - 10);
                    } else {
                        //Enter from the right
                        repositionParticle(particle, W + 5, Math.random() * H, Math.floor(Math.random() * 10) - 10);
                    }
                }
            }
        }

        function stepParticle(particle, particleIndex) {
            particle.tiltAngle += particle.tiltAngleIncremental;
            particle.y += (Math.cos(angle + particle.d) + 10 + particle.r / 2) / 2;
            particle.x += Math.sin(angle);
            particle.tilt = (Math.sin(particle.tiltAngle - (particleIndex / 3))) * 10;
        }

        function repositionParticle(particle, xCoordinate, yCoordinate, tilt) {
            particle.x = xCoordinate;
            particle.y = yCoordinate;
            particle.tilt = tilt;
        }

        function StartConfetti() {
            if (!_inited) {
                init();
            }
            
            W = window.innerWidth;
            H = window.innerHeight;
            canvas.width = W;
            canvas.height = H;
            (function animloop() {
                if (animationComplete) return null;
                animationHandler = requestAnimFrame(animloop);
                return Draw();
            })();
        }

        function ClearTimers() {
            clearTimeout(reactivationTimerHandler);
            clearTimeout(animationHandler);
        }

        function DeactivateConfetti() {
            confettiActive = false;
            ClearTimers();
        }

        function StopConfetti() {
            if (!_inited) {
                init();
            }
            
            animationComplete = true;
            if (typeof ctx === 'undefined') return;
            ctx.clearRect(0, 0, W, H);
            canvas.style.display = 'none';
        }

        function RestartConfetti() {
            if (!_inited) {
                init();
            }
            
            ClearTimers();
            StopConfetti();
            reactivationTimerHandler = setTimeout(function () {
                confettiActive = true;
                animationComplete = false;
                InitializeConfetti();
            }, 100);
        }

        window.requestAnimFrame = (function () {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function (callback) {
                return window.setTimeout(callback, 1000 / 60);
            };
        })();

        this.init = init;
        this.start = InitializeConfetti;
        this.stop = DeactivateConfetti;
        this.restart = RestartConfetti;
    };
    
    /**
     * Init
     */
    $('body').on('nasa_confetti_init', function() {
        $.confetti.init();
    });
    
    /**
     * Re-Start
     */
    $('body').on('nasa_confetti_start', function(e, t) {
        $.confetti.start();
        
        if (typeof t !== 'undefined') {
            setTimeout(function() {
                $('body').trigger('nasa_confetti_stop');
            }, t);
        }
    });

    /**
     * Re-Start
     */
    $('body').on('nasa_confetti_restart', function(e, t) {
        $.confetti.restart();
        
        if (typeof t !== 'undefined') {
            setTimeout(function() {
                $('body').trigger('nasa_confetti_stop');
            }, t);
        }
    });
    
    /**
     * Stop
     */
    $('body').on('nasa_confetti_stop', function() {
        $.confetti.stop();
    });
});
