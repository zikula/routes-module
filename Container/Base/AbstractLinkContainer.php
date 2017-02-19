<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.3 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Container\Base;

use Symfony\Component\Routing\RouterInterface;
use Zikula\Common\Translator\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\Core\Doctrine\EntityAccess;
use Zikula\Core\LinkContainer\LinkContainerInterface;
use Zikula\PermissionsModule\Api\PermissionApi;
use Zikula\UsersModule\Api\CurrentUserApi;
use Zikula\RoutesModule\Helper\ControllerHelper;

/**
 * This is the link container service implementation class.
 */
abstract class AbstractLinkContainer implements LinkContainerInterface
{
    use TranslatorTrait;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var PermissionApi
     */
    protected $permissionApi;

    /**
     * @var CurrentUserApi
     */
    private $currentUserApi;

    /**
     * @var ControllerHelper
     */
    protected $controllerHelper;

    /**
     * LinkContainer constructor.
     *
     * @param TranslatorInterface $translator       Translator service instance
     * @param Routerinterface     $router           Router service instance
     * @param PermissionApi       $permissionApi    PermissionApi service instance
     * @param CurrentUserApi      $currentUserApi   CurrentUserApi service instance
     * @param ControllerHelper    $controllerHelper ControllerHelper service instance
     */
    public function __construct(TranslatorInterface $translator, RouterInterface $router, PermissionApi $permissionApi, CurrentUserApi $currentUserApi, ControllerHelper $controllerHelper)
    {
        $this->setTranslator($translator);
        $this->router = $router;
        $this->permissionApi = $permissionApi;
        $this->currentUserApi = $currentUserApi;
        $this->controllerHelper = $controllerHelper;
    }

    /**
     * Sets the translator.
     *
     * @param TranslatorInterface $translator Translator service instance
     */
    public function setTranslator(/*TranslatorInterface */$translator)
    {
        $this->translator = $translator;
    }

    /**
     * Returns available header links.
     *
     * @param string $type The type to collect links for
     *
     * @return array Array of header links
     */
    public function getLinks($type = LinkContainerInterface::TYPE_ADMIN)
    {
        $contextArgs = ['api' => 'linkContainer', 'action' => 'getLinks'];
        $allowedObjectTypes = $this->controllerHelper->getObjectTypes('api', $contextArgs);

        $permLevel = LinkContainerInterface::TYPE_ADMIN == $type ? ACCESS_ADMIN : ACCESS_READ;

        // Create an array of links to return
        $links = [];

        if (LinkContainerInterface::TYPE_ACCOUNT == $type) {

            return $links;
        }

        $routeArea = LinkContainerInterface::TYPE_ADMIN == $type ? 'admin' : '';
        if (LinkContainerInterface::TYPE_ADMIN == $type) {
            if ($this->permissionApi->hasPermission($this->getBundleName() . '::', '::', ACCESS_READ)) {
                $links[] = [
                    'url' => $this->router->generate('zikularoutesmodule_route_index'),
                    'text' => $this->__('Frontend'),
                    'title' => $this->__('Switch to user area.'),
                    'icon' => 'home'
                ];
            }
        } else {
            if ($this->permissionApi->hasPermission($this->getBundleName() . '::', '::', ACCESS_ADMIN)) {
                $links[] = [
                    'url' => $this->router->generate('zikularoutesmodule_route_adminindex'),
                    'text' => $this->__('Backend'),
                    'title' => $this->__('Switch to administration area.'),
                    'icon' => 'wrench'
                ];
            }
        }
        
        if (in_array('route', $allowedObjectTypes)
            && $this->permissionApi->hasPermission($this->getBundleName() . ':Route:', '::', $permLevel)) {
            $links[] = [
                'url' => $this->router->generate('zikularoutesmodule_route_' . $routeArea . 'view'),
                'text' => $this->__('Routes'),
                'title' => $this->__('Route list')
            ];
        }
        if ($routeArea == 'admin' && $this->permissionApi->hasPermission($this->getBundleName() . '::', '::', ACCESS_ADMIN)) {
            $links[] = [
                'url' => $this->router->generate('zikularoutesmodule_config_config'),
                'text' => $this->__('Configuration'),
                'title' => $this->__('Manage settings for this application'),
                'icon' => 'wrench'
            ];
        }

        return $links;
    }

    /**
     * Returns the name of the providing bundle.
     *
     * @return string The bundle name
     */
    public function getBundleName()
    {
        return 'ZikulaRoutesModule';
    }
}
