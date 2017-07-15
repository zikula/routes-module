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

namespace Zikula\RoutesModule\Form\Handler\Route;

use Symfony\Component\Routing\RouteCollection;
use Zikula\Bundle\CoreBundle\CacheClearer;
use Zikula\RoutesModule\Entity\RouteEntity;
use Zikula\RoutesModule\Form\Handler\Route\Base\AbstractEditHandler;
use Zikula\RoutesModule\Helper\PathBuilderHelper;
use Zikula\RoutesModule\Helper\RouteDumperHelper;
use Zikula\RoutesModule\Helper\SanitizeHelper;

/**
 * This handler class handles the page events of the Form called by the zikulaRoutesModule_route_edit() function.
 * It aims on the route object type.
 */
class EditHandler extends AbstractEditHandler
{
    /**
     * @var PathBuilderHelper
     */
    private $pathBuilderHelper;

    /**
     * @var RouteDumperHelper
     */
    private $routeDumperHelper;

    /**
     * @var SanitizeHelper
     */
    private $sanitizeHelper;

    /**
     * @var CacheClearer
     */
    private $cacheClearer;

    /**
     * Sets the path builder helper.
     *
     * @param PathBuilderHelper $pathBuilderHelper Path builder helper
     */
    public function setPathBuilderHelper(PathBuilderHelper $pathBuilderHelper)
    {
        $this->pathBuilderHelper = $pathBuilderHelper;
    }

    /**
     * Sets the route dumper helper.
     *
     * @param RouteDumperHelper $routeDumperHelper Route dumper helper
     */
    public function setRouteDumperHelper(RouteDumperHelper $routeDumperHelper)
    {
        $this->routeDumperHelper = $routeDumperHelper;
    }

    /**
     * Sets the sanitize helper.
     *
     * @param SanitizeHelper $sanitizeHelper Sanitize helper
     */
    public function setSanitizeHelper(SanitizeHelper $sanitizeHelper)
    {
        $this->sanitizeHelper = $sanitizeHelper;
    }

    /**
     * Sets the cache clearer.
     *
     * @param CacheClearer $cacheClearer Cache clearer
     */
    public function setCacheClearer(CacheClearer $cacheClearer)
    {
        $this->cacheClearer = $cacheClearer;
    }

    /**
     * @inheritDoc
     */
    public function applyAction(array $args = [])
    {
        $this->sanitizeInput();
        if ($this->hasConflicts()) {
            return false;
        }

        $return = parent::applyAction($args);

        $this->cacheClearer->clear('symfony.routing');

        // reload **all** JS routes
        $this->routeDumperHelper->dumpJsRoutes(null);

        return $return;
    }

    /**
     * Ensures validity of input data.
     */
    private function sanitizeInput()
    {
        $entity = $this->entityRef;

        list($controller,) = $this->sanitizeHelper->sanitizeController($entity['controller']);
        list($action,) = $this->sanitizeHelper->sanitizeAction($entity['action']);

        $entity['controller'] = $controller;
        $entity['action'] = $action;
        $entity['sort'] = 0;

        $this->entityRef = $entity;
    }

    /**
     * Checks for potential conflict.
     *
     * @return boolean True if a critical error occured, else false.
     */
    private function hasConflicts()
    {
        $newPath = $this->pathBuilderHelper->getPathWithBundlePrefix($this->entityRef);

        /** @var RouteCollection $routeCollection */
        $routeCollection = $this->router->getRouteCollection();

        $errors = [];
        foreach ($routeCollection->all() as $route) {
            $path = $route->getPath();
            if (in_array($path, ['/{url}', '/{path}'])) {
                continue;
            }

            if ($path === $newPath) {
                $errors[] = [
                    'type' => 'SAME',
                    'path' => $path
                ];
                continue;
            }

            $pathRegExp = preg_quote(preg_replace("/{(.+)}/", "____DUMMY____", $path), '/');
            $pathRegExp = "#^" . str_replace('____DUMMY____', '(.+)', $pathRegExp) . "$#";

            $matches = [];
            preg_match($pathRegExp, $newPath, $matches);
            if (count($matches)) {
                $errors[] = [
                    'type' => 'SIMILAR',
                    'path' => $path
                ];
            }
        }

        $hasCriticalErrors = false;

        foreach ($errors as $error) {
            if ($error['type'] == 'SAME') {
                $message = $this->__('It looks like you created or updated a route with a path which already exists. This is an error in most cases.');
                $hasCriticalErrors = true;
            } else {
                $message = $this->__f('The path of the route you created or updated looks similar to the following already existing path: %s Are you sure you haven\'t just introduced a conflict?', ['%s' => $error['path']]);
            }
            $this->request->getSession()->getFlashBag()->add('error', $message);
        }

        return $hasCriticalErrors;
    }
}
