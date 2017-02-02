<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.2 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Listener;

use Zikula\RoutesModule\Listener\Base\AbstractKernelListener;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event handler implementation class for Symfony kernel events.
 */
class KernelListener extends AbstractKernelListener
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return parent::getSubscribedEvents();
    }
    
    /**
     * {@inheritdoc}
     */
    public function onRequest(GetResponseEvent $event)
    {
        parent::onRequest($event);
    
        // if we return a response the system jumps to the kernel.response event
        // immediately without executing any other listeners or controllers
        // $event->setResponse(new Response('This site is currently not active!'));
    
        // init stuff and add it to the request (for example a locale)
        // $testMessage = 'Hello from routes app';
        // $event->getRequest()->attributes->set('ZikulaRoutesModule_test', $testMessage);
    
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
     * {@inheritdoc}
     */
    public function onController(FilterControllerEvent $event)
    {
        parent::onController($event);
    
        // $controller = $event->getController();
        // ...
    
        // the controller can be changed to any PHP callable
        // $event->setController($controller);
    
    
        // check for certain controller types (or implemented interface types!)
        // for example imagine an interface named SpecialFlaggedController
    
        // The passed $controller passed can be either a class or a Closure.
        // If it is a class, it comes in array format.
        // if (!is_array($controller)) {
        //     return;
        // }
    
        // if ($controller[0] instanceof SpecialFlaggedController) {
        //     ...
        // }
    
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
     * {@inheritdoc}
     */
    public function onView(GetResponseForControllerResultEvent $event)
    {
        parent::onView($event);
    
        // $val = $event->getControllerResult();
    
        // $response = new Response();
    
        // ... customise the response using the return value
    
        // $event->setResponse($response);
    
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
     * {@inheritdoc}
     */
    public function onResponse(FilterResponseEvent $event)
    {
        parent::onResponse($event);
    
        // $response = $event->getResponse();
    
        // ... modify the response object
    
        // $testMessage = $event->getRequest()->attributes->get('ZikulaRoutesModule_test');
        // now $testMessage should be: 'Hello from routes app'
    
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
     * {@inheritdoc}
     */
    public function onFinishRequest(FinishRequestEvent $event)
    {
        parent::onFinishRequest($event);
    
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
     * {@inheritdoc}
     */
    public function onTerminate(PostResponseEvent $event)
    {
        parent::onTerminate($event);
    
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
     * {@inheritdoc}
     */
    public function onException(GetResponseForExceptionEvent $event)
    {
        parent::onException($event);
    
        // retrieve exception object from the received event
        // $exception = $event->getException();
    
        // if ($exception instanceof MySpecialException
        //     || $exception instanceof MySpecialExceptionInterface) {
            // Create a response object and customise it to display the exception details
            // $response = new Response();
    
            // $message = sprintf(
            //     'routes App Error says: %s with code: %s',
            //     $exception->getMessage(),
            //     $exception->getCode()
            // );
    
            // $response->setContent($message);
    
            // HttpExceptionInterface is a special type of exception that
            // holds the status code and header details
            // if ($exception instanceof HttpExceptionInterface) {
            //     $response->setStatusCode($exception->getStatusCode());
            //     $response->headers->replace($exception->getHeaders());
            // } else {
            //     $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            // }
    
            // send modified response back to the event
            // $event->setResponse($response);
        // }
    
        // you can alternatively set a new Exception
        // $exception = new \Exception('Some special exception');
        // $event->setException($exception);
    
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
