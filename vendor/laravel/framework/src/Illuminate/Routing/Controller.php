<?php

namespace Illuminate\Routing;

use BadMethodCallException;
use Jenssegers\Agent\Agent;

abstract class Controller
{
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Register middleware on the controller.
     *
     * @param \Closure|array|string $middleware
     * @param array $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array)$middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new ControllerMiddlewareOptions($options);
    }

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Execute an action on the controller.
     *
     * @param string $method
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return $this->{$method}(...array_values($parameters));
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }

    public function getBrwsrInfo()
    {
        $agnt = new Agent();
        $chk_dsktp = ($agnt->isDesktop() === TRUE) ? 'Desktop' : '';
        $chk_iphn = ($agnt->isPhone() === TRUE) ? 'iPhone' : '';
        $chk_mbl = ($agnt->isMobile() === TRUE) ? 'Mobile' : '';
        $chk_tblt = ($agnt->isTablet() === TRUE) ? 'Tablet' : '';
        $device = '';
        if (!empty($chk_dsktp)) {
            $device = $chk_dsktp;
        } elseif (!empty($chk_iphn)) {
            $device = $chk_iphn;
        } elseif (!empty($chk_mbl)) {
            $device = $chk_mbl;
        } elseif (!empty($chk_tblt)) {
            $device = $chk_tblt;
        }

        $browser = $agnt->browser();
        $browser_rslt = $device . ' Device ' . PHP_EOL . '' . $browser . ' browser | Version:- ' . $agnt->version($browser);

        return $browser_rslt;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////// Ip Related Code ////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////

    public static function get_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
