<?php

/**
 * A GoogleReaderSource API Method Map
 *
 * Refer to the HttpSource plugin for how to build a method map
 *
 * @link https://github.com/imsamurai/cakephp-httpsource-datasource
 * @see http://code.google.com/p/pyrfeed/wiki/GoogleReaderAPI
 */
$config['GoogleReaderSource']['config_version'] = 2;

$CF = HttpSourceConfigFactory::instance();
$Config = $CF->config();

$Config
        ->add(
                $CF->endpoint()
                ->id(1)
                ->methodRead()
                ->table('tag/list')
                ->addCondition($CF->condition()->name('output')->defaults('json'))
                ->addCondition($CF->condition()->name('count')->map(null, 'n')->defaults(20))
                ->addCondition($CF->condition()->name('client'))
                ->addCondition($CF->condition()->name('order')->map(null, 'r'))
                ->addCondition($CF->condition()->name('start_time')->map(null, 'ot'))
                ->addCondition($CF->condition()->name('timestamp')->map(null, 'ck'))
                ->addCondition($CF->condition()->name('exclude_target')->map(null, 'xt'))
                ->addCondition($CF->condition()->name('continuation')->map(null, 'c'))
                ->result($CF->result()->map(function($result) {
                                    return (array) $result['tags'];
                                }))
        )
        ->add(
                $CF->endpoint()
                ->id(2)
                ->methodRead()
                ->table('subscription/list')
                ->addCondition($CF->condition()->name('output')->defaults('json'))
                ->addCondition($CF->condition()->name('count')->map(null, 'n')->defaults(20))
                ->addCondition($CF->condition()->name('client'))
                ->addCondition($CF->condition()->name('order')->map(null, 'r'))
                ->addCondition($CF->condition()->name('start_time')->map(null, 'ot'))
                ->addCondition($CF->condition()->name('timestamp')->map(null, 'ck'))
                ->addCondition($CF->condition()->name('exclude_target')->map(null, 'xt'))
                ->addCondition($CF->condition()->name('continuation')->map(null, 'c'))
                ->result($CF->result()->map(function($result) {
                                    return (array) $result['subscriptions'];
                                }))
        )
        ->readParams(array(
            'n' => 'limit'
        ))

;

$config['GoogleReaderSource']['config'] = $Config;