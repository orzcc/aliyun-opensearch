<?php
namespace Orzcc\Opensearch\Factories;

use Orzcc\Opensearch\Sdk\CloudsearchClient;
use Orzcc\Opensearch\Sdk\CloudsearchSearch;

class OpensearchFactory
{
    /**
     * Make a new opensearch client.
     *
     * @param string[] $config
     *
     * @return CloudsearchClient
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);
        return $this->getClient($config);
    }
    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('client_id', $config)
            || !array_key_exists('client_secret', $config)
            || !array_key_exists('host', $config)
            || !array_key_exists('app', $config)) {
            throw new \InvalidArgumentException('The opensearch client requires authentication.');
        }
        return array_only($config, ['client_id', 'client_secret', 'host', 'app', 'format']);
    }

    /**
     * Get the opensearch client.
     *
     * @param string[] $auth
     *
     * @return CloudsearchClient
     */
    protected function getClient(array $config)
    {
        $client = new CloudsearchClient( 
            $config['client_id'], 
            $config['client_secret'], 
            $config['host'],
            'aliyun'
        );

        $search = new CloudsearchSearch($client);
        $search->addIndex($config['app']);

        return $search;
    }
}