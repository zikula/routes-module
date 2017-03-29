<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.4 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zikula\Core\Controller\AbstractController;
use Zikula\ThemeModule\Engine\Annotation\Theme;

/**
 * Update controller for renewing route information on demand.
 */
class UpdateController extends AbstractController
{
    /**
     * Reloads the routes and dumps exposed JS routes.
     *
     * @Route("/update/reload",
     *        methods = {"GET", "POST"}
     * )
     * @Theme("admin")
     *
     * @param Request $request Current request instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function reloadAction(Request $request)
    {
        $objectType = 'route';
        if (!$this->hasPermission('ZikulaRoutesModule:' . ucfirst($objectType) . ':', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        $cacheClearer = $this->get('zikula.cache_clearer');
        $cacheClearer->clear('symfony.routing');

        $this->addFlash('status', $this->__('Done! Routes reloaded.'));

        // reload **all** JS routes
        $this->dumpJsRoutes();

        return $this->redirectToRoute('zikularoutesmodule_route_adminview');
    }

    /**
     * Renews multilingual routing settings.
     *
     * @Route("/update/renew",
     *        methods = {"GET", "POST"}
     * )
     * @Theme("admin")
     *
     * @param Request $request Current request instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function renewAction(Request $request)
    {
        $objectType = 'route';
        if (!$this->hasPermission('ZikulaRoutesModule:' . ucfirst($objectType) . ':', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        // Renew the routing settings.
        $this->get('zikula_routes_module.multilingual_routing_helper')->reloadMultilingualRoutingSettings();

        $this->addFlash('status', $this->__('Done! Routing settings renewed.'));

        return $this->redirectToRoute('zikularoutesmodule_route_adminview');
    }

    /**
     * Dumps the routes exposed to javascript.
     *
     * @Route("/update/dump/{lang}",
     *        name = "zikularoutesmodule_update_dumpjsroutes",
     *        methods = {"GET"}
     * )
     * @Theme("admin")
     *
     * @param Request $request Current request instance
     *
     * @return Response Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function dumpJsRoutesAction(Request $request, $lang = null)
    {
        $objectType = 'route';
        if (!$this->hasPermission('ZikulaRoutesModule:' . ucfirst($objectType) . ':', '::', ACCESS_ADMIN)) {
            throw new AccessDeniedException();
        }

        $this->dumpJsRoutes($lang);

        return $this->redirectToRoute('zikularoutesmodule_route_adminview');
    }

    /**
     * Dumps exposed JS routes to '/web/js/fos_js_routes.js'.
     */
    private function dumpJsRoutes($lang = null)
    {
        $routeDumperHelper = $this->get('zikula_routes_module.route_dumper_helper');
        $result = $routeDumperHelper->dumpJsRoutes($lang);

        if ($result == '') {
            $this->addFlash('status', $this->__f('Done! Exposed JS Routes dumped to %s.', ['%s' => 'web/js/fos_js_routes.js']));
        } else {
            $this->addFlash('error', $this->__f('Error! There was an error dumping exposed JS Routes: %s', ['%s' => $result]));
        }
    }
}
