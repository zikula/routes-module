<?php

/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <info@ziku.la>.
 * @see https://ziku.la
 * @version Generated by ModuleStudio 1.4.0 (https://modulestudio.de).
 */

declare(strict_types=1);

namespace Zikula\RoutesModule\Event\Base;

use Zikula\RoutesModule\Entity\RouteEntity;

/**
 * Event base class for filtering route processing.
 */
class AbstractRoutePreUpdateEvent
{
    /**
     * @var RouteEntity Reference to treated entity instance.
     */
    protected $route;

    /**
     * @var array Entity change set for preUpdate events.
     */
    protected $entityChangeSet = [];

    public function __construct(RouteEntity $route, array $entityChangeSet = [])
    {
        $this->route = $route;
        $this->entityChangeSet = $entityChangeSet;
    }

    /**
     * @return RouteEntity
     */
    public function getRoute(): RouteEntity
    {
        return $this->route;
    }

    /**
     * @return array Entity change set
     */
    public function getEntityChangeSet(): array
    {
        return $this->entityChangeSet;
    }
}
