<?php

namespace vfalconi\TerminusCITools\Commands;

use Pantheon\Terminus\Commands\TerminusCommand;
use Pantheon\Terminus\Commands\WorkflowProcessingTrait;
use Pantheon\Terminus\Exceptions\TerminusException;
use Pantheon\Terminus\Site\SiteAwareInterface;
use Pantheon\Terminus\Site\SiteAwareTrait;

class CheckEnvCommand extends TerminusCommand implements SiteAwareInterface
{
    use SiteAwareTrait;
    use WorkflowProcessingTrait;

    private function notDev($site_env)
    {
        $env = $this->getEnv($site_env);

        if ($env->getName() != 'test' && $env->getName() != 'live') {
            throw new TerminusException('This command can only be used to check the test or live environments.');
        }

        return $env;
    }

    /**
     * Check whether an environment has changes to deploy.
     *
     * @command checkEnv
     * @param string $site_env SITE_ID.ENV
     */
    public function checkEnv($site_env)
    {
        $env = $this->notDev($site_env);
        $this->requireSiteIsNotFrozen($site_env);
        $site = $this->getSiteById($site_env);
        $fields = [
            'site' => $site->getName(),
            'env' => $env->getName(),
        ];

        if ($env->isInitialized()) {
            if ($env->hasDeployableCode()) {
                $this->log()->info('{site} has changes to deploy', $fields);
                return 'deployable';
            } else {
                throw new TerminusException('{site}\'s {env} has nothing to deploy', $fields);
            }
        }
    }
}
