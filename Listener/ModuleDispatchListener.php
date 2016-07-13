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

namespace Zikula\RoutesModule\Listener;

use Zikula\RoutesModule\Listener\Base\ModuleDispatchListener as BaseModuleDispatchListener;
use Zikula\Core\Event\GenericEvent;

/**
 * Event handler implementation class for dispatching modules.
 */
class ModuleDispatchListener extends BaseModuleDispatchListener
{
    /**
     * Makes our handlers known to the event system.
     */
    public static function getSubscribedEvents()
    {
        return parent::getSubscribedEvents();
    }
    
    /**
     * Listener for the `module_dispatch.postloadgeneric` event.
     *
     * Called after a module api or controller has been loaded.
     * Receives the args `['modinfo' => $modinfo, 'type' => $type, 'force' => $force, 'api' => $api]`.
     *
     * @param GenericEvent $event The event instance.
     */
    public function postLoadGeneric(GenericEvent $event)
    {
        parent::postLoadGeneric($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.preexecute` event.
     *
     * Occurs in `ModUtil::exec()` before function call with the following args:
     *     `[
     *          'modname' => $modname,
     *          'modfunc' => $modfunc,
     *          'args' => $args,
     *          'modinfo' => $modinfo,
     *          'type' => $type,
     *          'api' => $api
     *      ]`
     * .
     *
     * @param GenericEvent $event The event instance.
     */
    public function preExecute(GenericEvent $event)
    {
        parent::preExecute($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.postexecute` event.
     *
     * Occurs in `ModUtil::exec()` after function call with the following args:
     *     `[
     *          'modname' => $modname,
     *          'modfunc' => $modfunc,
     *          'args' => $args,
     *          'modinfo' => $modinfo,
     *          'type' => $type,
     *          'api' => $api
     *      ]`
     * .
     * Receives the modules output with `$event->getData();`.
     * Can modify this output with `$event->setData($data);`.
     *
     * @param GenericEvent $event The event instance.
     */
    public function postExecute(GenericEvent $event)
    {
        parent::postExecute($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.custom_classname` event.
     *
     * In order to override the classname calculated in `ModUtil::exec()`.
     * In order to override a pre-existing controller/api method, use this event type to override the class name that is loaded.
     * This allows to override the methods using inheritance.
     * Receives no subject, args of `['modname' => $modname, 'modinfo' => $modinfo, 'type' => $type, 'api' => $api]`
     * and 'event data' of `$className`. This can be altered by setting `$event->setData()` followed by `$event->stopPropagation()`.
     *
     * @param GenericEvent $event The event instance.
     */
    public function customClassname(GenericEvent $event)
    {
        parent::customClassName($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.service_links` event.
     *
     * Occurs when building admin menu items.
     * Adds sublinks to a Services menu that is appended to all modules if populated.
     * Triggered by module_dispatch.postexecute in bootstrap.
     *
     * @param GenericEvent $event The event instance.
     */
    public function serviceLinks(GenericEvent $event)
    {
        parent::customClassName($event);
    
        // Format data like so:
        // $serviceManager = \ServiceUtil::getManager();
        // $event->data[] = ['url' => $serviceManager->get('router')->generate('zikularoutesmodule_user_index'), 'text' => $serviceManager->get('translator.default')->__('Link text')];
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
}
