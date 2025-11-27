<?php

namespace App\Extensions;

use Illuminate\Database\Connectors\PostgresConnector as BasePostgresConnector;
use PDO;

class NeonPostgresConnector extends BasePostgresConnector
{
    /**
     * Create a new PDO connection.
     *
     * @param  string  $dsn
     * @param  array   $config
     * @param  array   $options
     * @return \PDO
     */
    public function createConnection($dsn, array $config, array $options)
    {
        // Append Neon endpoint to DSN if available
        $dsn = $this->appendNeonEndpoint($dsn, $config);
        
        return parent::createConnection($dsn, $config, $options);
    }
    
    /**
     * Append Neon endpoint to DSN for SNI routing.
     *
     * @param  string  $dsn
     * @param  array   $config
     * @return string
     */
    protected function appendNeonEndpoint(string $dsn, array $config): string
    {
        // Already has endpoint in DSN, skip
        if (str_contains($dsn, 'options=')) {
            return $dsn;
        }
        
        $endpoint = $this->resolveNeonEndpoint($config);
        
        if ($endpoint) {
            $dsn .= ";options=endpoint={$endpoint}";
        }
        
        return $dsn;
    }
    
    /**
     * Resolve the Neon endpoint from config or host.
     *
     * @param  array  $config
     * @return string|null
     */
    protected function resolveNeonEndpoint(array $config): ?string
    {
        // First, check for explicit neon_endpoint config
        if (! empty($config['neon_endpoint'])) {
            return $config['neon_endpoint'];
        }
        
        // Second, try to extract from host (ep-xxx-xxx-xxx.region.aws.neon.tech)
        $host = $config['host'] ?? '';
        
        if (preg_match('/^(ep-[a-z0-9-]+)/', $host, $matches)) {
            return $matches[1];
        }
        
        // Third, try to extract from DATABASE_URL if present
        if (! empty($config['url'])) {
            $parsed = parse_url($config['url']);
            $urlHost = $parsed['host'] ?? '';
            
            if (preg_match('/^(ep-[a-z0-9-]+)/', $urlHost, $matches)) {
                return $matches[1];
            }
        }
        
        return null;
    }

    /**
     * Get the PDO options based on the configuration, ensuring options is an array.
     *
     * @param  array  $config
     * @return array
     */
    public function getOptions(array $config)
    {
        $options = $config['options'] ?? [];

        if (! is_array($options)) {
            $options = [];
        }

        return array_diff_key($this->options, $options) + $options;
    }
}
