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

namespace Zikula\RoutesModule\Helper\Base;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Zikula\ExtensionsModule\Api\ApiInterface\VariableApiInterface;
use Zikula\UsersModule\Api\ApiInterface\CurrentUserApiInterface;
use Zikula\UsersModule\Constant as UsersConstant;
use Zikula\RoutesModule\Helper\PermissionHelper;

/**
 * Entity collection filter helper base class.
 */
abstract class AbstractCollectionFilterHelper
{
    /**
     * @var RequestStack
     */
    protected $requestStack;
    
    /**
     * @var PermissionHelper
     */
    protected $permissionHelper;
    
    /**
     * @var CurrentUserApiInterface
     */
    protected $currentUserApi;
    
    /**
     * @var bool Fallback value to determine whether only own entries should be selected or not
     */
    protected $showOnlyOwnEntries = false;
    
    public function __construct(
        RequestStack $requestStack,
        PermissionHelper $permissionHelper,
        CurrentUserApiInterface $currentUserApi,
        VariableApiInterface $variableApi
    ) {
        $this->requestStack = $requestStack;
        $this->permissionHelper = $permissionHelper;
        $this->currentUserApi = $currentUserApi;
        $this->showOnlyOwnEntries = (bool)$variableApi->get('ZikulaRoutesModule', 'showOnlyOwnEntries');
    }
    
    /**
     * Returns an array of additional template variables for view quick navigation forms.
     */
    public function getViewQuickNavParameters(string $objectType = '', string $context = '', array $args = []): array
    {
        if (!in_array($context, ['controllerAction', 'api', 'actionHandler', 'block', 'contentType'], true)) {
            $context = 'controllerAction';
        }
    
        if ('route' === $objectType) {
            return $this->getViewQuickNavParametersForRoute($context, $args);
        }
    
        return [];
    }
    
    /**
     * Adds quick navigation related filter options as where clauses.
     */
    public function addCommonViewFilters(string $objectType, QueryBuilder $qb): QueryBuilder
    {
        if ('route' === $objectType) {
            return $this->addCommonViewFiltersForRoute($qb);
        }
    
        return $qb;
    }
    
    /**
     * Adds default filters as where clauses.
     */
    public function applyDefaultFilters(string $objectType, QueryBuilder $qb, array $parameters = []): QueryBuilder
    {
        if ('route' === $objectType) {
            return $this->applyDefaultFiltersForRoute($qb, $parameters);
        }
    
        return $qb;
    }
    
    /**
     * Returns an array of additional template variables for view quick navigation forms.
     */
    protected function getViewQuickNavParametersForRoute(string $context = '', array $args = []): array
    {
        $parameters = [];
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return $parameters;
        }
    
        $parameters['workflowState'] = $request->query->get('workflowState', '');
        $parameters['schemes'] = $request->query->get('schemes', '');
        $parameters['methods'] = $request->query->get('methods', '');
        $parameters['q'] = $request->query->get('q', '');
        $parameters['prependBundlePrefix'] = $request->query->get('prependBundlePrefix', '');
        $parameters['translatable'] = $request->query->get('translatable', '');
    
        return $parameters;
    }
    
    /**
     * Adds quick navigation related filter options as where clauses.
     */
    protected function addCommonViewFiltersForRoute(QueryBuilder $qb): QueryBuilder
    {
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return $qb;
        }
        $routeName = $request->get('_route', '');
        if (false !== strpos($routeName, 'edit')) {
            return $qb;
        }
    
        $parameters = $this->getViewQuickNavParametersForRoute();
        foreach ($parameters as $k => $v) {
            if (null === $v) {
                continue;
            }
            if (in_array($k, ['q', 'searchterm'], true)) {
                // quick search
                if (!empty($v)) {
                    $qb = $this->addSearchFilter('route', $qb, $v);
                }
                continue;
            }
            if (in_array($k, ['prependBundlePrefix', 'translatable'], true)) {
                // boolean filter
                if ('no' === $v) {
                    $qb->andWhere('tbl.' . $k . ' = 0');
                } elseif ('yes' === $v || '1' === $v) {
                    $qb->andWhere('tbl.' . $k . ' = 1');
                }
                continue;
            }
    
            if (is_array($v)) {
                continue;
            }
    
            // field filter
            if ((!is_numeric($v) && '' !== $v) || (is_numeric($v) && 0 < $v)) {
                if ('workflowState' === $k && 0 === strpos($v, '!')) {
                    $qb->andWhere('tbl.' . $k . ' != :' . $k)
                       ->setParameter($k, substr($v, 1));
                } elseif (0 === strpos($v, '%')) {
                    $qb->andWhere('tbl.' . $k . ' LIKE :' . $k)
                       ->setParameter($k, '%' . substr($v, 1) . '%');
                } elseif (in_array($k, ['schemes', 'methods'], true)) {
                    // multi list filter
                    $qb->andWhere('tbl.' . $k . ' LIKE :' . $k)
                       ->setParameter($k, '%' . $v . '%');
                } else {
                    $qb->andWhere('tbl.' . $k . ' = :' . $k)
                       ->setParameter($k, $v);
                }
            }
        }
    
        return $this->applyDefaultFiltersForRoute($qb, $parameters);
    }
    
    /**
     * Adds default filters as where clauses.
     */
    protected function applyDefaultFiltersForRoute(QueryBuilder $qb, array $parameters = []): QueryBuilder
    {
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return $qb;
        }
    
        $showOnlyOwnEntries = (bool)$request->query->getInt('own', (int) $this->showOnlyOwnEntries);
        if ($showOnlyOwnEntries) {
            $qb = $this->addCreatorFilter($qb);
        }
    
        $routeName = $request->get('_route', '');
        $isAdminArea = false !== strpos($routeName, 'zikularoutesmodule_route_admin');
        if ($isAdminArea) {
            return $qb;
        }
    
        if (!array_key_exists('workflowState', $parameters) || empty($parameters['workflowState'])) {
            // per default we show approved routes only
            $onlineStates = ['approved'];
            $qb->andWhere('tbl.workflowState IN (:onlineStates)')
               ->setParameter('onlineStates', $onlineStates);
        }
    
        return $qb;
    }
    
    /**
     * Adds a where clause for search query.
     */
    public function addSearchFilter(string $objectType, QueryBuilder $qb, string $fragment = ''): QueryBuilder
    {
        if ('' === $fragment) {
            return $qb;
        }
    
        $filters = [];
        $parameters = [];
    
        if ('route' === $objectType) {
            $filters[] = 'tbl.bundle LIKE :searchBundle';
            $parameters['searchBundle'] = '%' . $fragment . '%';
            $filters[] = 'tbl.controller LIKE :searchController';
            $parameters['searchController'] = '%' . $fragment . '%';
            $filters[] = 'tbl.action LIKE :searchAction';
            $parameters['searchAction'] = '%' . $fragment . '%';
            $filters[] = 'tbl.path LIKE :searchPath';
            $parameters['searchPath'] = '%' . $fragment . '%';
            $filters[] = 'tbl.host LIKE :searchHost';
            $parameters['searchHost'] = '%' . $fragment . '%';
            $filters[] = 'tbl.schemes = :searchSchemes';
            $parameters['searchSchemes'] = $fragment;
            $filters[] = 'tbl.methods = :searchMethods';
            $parameters['searchMethods'] = $fragment;
            $filters[] = 'tbl.translationPrefix LIKE :searchTranslationPrefix';
            $parameters['searchTranslationPrefix'] = '%' . $fragment . '%';
            $filters[] = 'tbl.condition LIKE :searchCondition';
            $parameters['searchCondition'] = '%' . $fragment . '%';
            $filters[] = 'tbl.description LIKE :searchDescription';
            $parameters['searchDescription'] = '%' . $fragment . '%';
            if (is_numeric($fragment)) {
                $filters[] = 'tbl.sort = :searchSort';
                $parameters['searchSort'] = $fragment;
            }
        }
    
        $qb->andWhere('(' . implode(' OR ', $filters) . ')');
    
        foreach ($parameters as $parameterName => $parameterValue) {
            $qb->setParameter($parameterName, $parameterValue);
        }
    
        return $qb;
    }
    
    /**
     * Adds a filter for the createdBy field.
     */
    public function addCreatorFilter(QueryBuilder $qb, int $userId = null): QueryBuilder
    {
        if (null === $userId) {
            $userId = $this->currentUserApi->isLoggedIn()
                ? (int)$this->currentUserApi->get('uid')
                : UsersConstant::USER_ID_ANONYMOUS
            ;
        }
    
        $qb->andWhere('tbl.createdBy = :userId')
           ->setParameter('userId', $userId);
    
        return $qb;
    }
}
