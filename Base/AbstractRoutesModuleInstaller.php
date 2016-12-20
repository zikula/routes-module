<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.0 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Base;

use Doctrine\DBAL\Connection;
use RuntimeException;
use Zikula\Core\AbstractExtensionInstaller;
use Zikula_Workflow_Util;

/**
 * Installer base class.
 */
abstract class AbstractRoutesModuleInstaller extends AbstractExtensionInstaller
{
    /**
     * Install the ZikulaRoutesModule application.
     *
     * @return boolean True on success, or false
     *
     * @throws RuntimeException Thrown if database tables can not be created or another error occurs
     */
    public function install()
    {
        $logger = $this->container->get('logger');
    
        // create all tables from according entity definitions
        try {
            $this->schemaTool->create($this->listEntityClasses());
        } catch (\Exception $e) {
            $this->addFlash('error', $this->__('Doctrine Exception') . ': ' . $e->getMessage());
            $logger->error('{app}: Could not create the database tables during installation. Error details: {errorMessage}.', ['app' => 'ZikulaRoutesModule', 'errorMessage' => $e->getMessage()]);
    
            return false;
        }
    
        // create the default data
        $this->createDefaultData();
    
        
    
        // initialisation successful
        return true;
    }
    
    /**
     * Upgrade the ZikulaRoutesModule application from an older version.
     *
     * If the upgrade fails at some point, it returns the last upgraded version.
     *
     * @param integer $oldVersion Version to upgrade from
     *
     * @return boolean True on success, false otherwise
     *
     * @throws RuntimeException Thrown if database tables can not be updated
     */
    public function upgrade($oldVersion)
    {
    /*
        $logger = $this->container->get('logger');
    
        // Upgrade dependent on old version number
        switch ($oldVersion) {
            case '1.0.0':
                // do something
                // ...
                // update the database schema
                try {
                    $this->schemaTool->update($this->listEntityClasses());
                } catch (\Exception $e) {
                    $this->addFlash('error', $this->__('Doctrine Exception') . ': ' . $e->getMessage());
                    $logger->error('{app}: Could not update the database tables during the upgrade. Error details: {errorMessage}.', ['app' => 'ZikulaRoutesModule', 'errorMessage' => $e->getMessage()]);
    
                    return false;
                }
        }
    */
    
        // update successful
        return true;
    }
    
    /**
     * Uninstall ZikulaRoutesModule.
     *
     * @return boolean True on success, false otherwise
     *
     * @throws RuntimeException Thrown if database tables or stored workflows can not be removed
     */
    public function uninstall()
    {
        $logger = $this->container->get('logger');
    
        // delete stored object workflows
        $result = Zikula_Workflow_Util::deleteWorkflowsForModule('ZikulaRoutesModule');
        if (false === $result) {
            $this->addFlash('error', $this->__f('An error was encountered while removing stored object workflows for the %s extension.', ['%s' => 'ZikulaRoutesModule']));
            $logger->error('{app}: Could not remove stored object workflows during uninstallation.', ['app' => 'ZikulaRoutesModule']);
    
            return false;
        }
    
        try {
            $this->schemaTool->drop($this->listEntityClasses());
        } catch (\Exception $e) {
            $this->addFlash('error', $this->__('Doctrine Exception') . ': ' . $e->getMessage());
            $logger->error('{app}: Could not remove the database tables during uninstallation. Error details: {errorMessage}.', ['app' => 'ZikulaRoutesModule', 'errorMessage' => $e->getMessage()]);
    
            return false;
        }
    
        // uninstall subscriber hooks
        $this->hookApi->uninstallSubscriberHooks($this->bundle->getMetaData());
        
    
        // uninstallation successful
        return true;
    }
    
    /**
     * Build array with all entity classes for ZikulaRoutesModule.
     *
     * @return array list of class names
     */
    protected function listEntityClasses()
    {
        $classNames = [];
        $classNames[] = 'Zikula\RoutesModule\Entity\RouteEntity';
    
        return $classNames;
    }
    
    /**
     * Create the default data for ZikulaRoutesModule.
     *
     * @return void
     */
    protected function createDefaultData()
    {
        $entityManager = $this->container->get('doctrine.orm.default_entity_manager');
        $logger = $this->container->get('logger');
        $request = $this->container->get('request_stack')->getMasterRequest();
        
        $entityClass = 'Zikula\RoutesModule\Entity\RouteEntity';
        $entityManager->getRepository($entityClass)->truncateTable($logger);
    }
}
