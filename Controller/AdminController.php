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

namespace Zikula\RoutesModule\Controller;

use Zikula\RoutesModule\Controller\Base\AbstractAdminController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller class providing navigation and interaction functionality.
 */
class AdminController extends AbstractAdminController
{
    /**
     * This is the default action handling the main area called without defining arguments.
     *
     * @Route("/admin",
     *        methods = {"GET"}
     * )
     *
     * @param Request $request Current request instance
     *
     * @return mixed Output
     *
     * @throws AccessDeniedException Thrown if the user doesn't have required permissions
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    // feel free to add your own controller methods here
}
