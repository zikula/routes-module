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

namespace Zikula\RoutesModule\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Zikula\Core\Doctrine\EntityAccess;
use Zikula\RoutesModule\Traits\StandardFieldsTrait;
use Zikula\RoutesModule\Validator\Constraints as RoutesAssert;

/**
 * Entity class that defines the entity structure and behaviours.
 *
 * This is the base entity class for route entities.
 * The following annotation marks it as a mapped superclass so subclasses
 * inherit orm properties.
 *
 * @ORM\MappedSuperclass
 *
 * @abstract
 */
abstract class AbstractRouteEntity extends EntityAccess
{
    /**
     * Hook standard fields behaviour embedding createdBy, updatedBy, createdDate, updatedDate fields.
     */
    use StandardFieldsTrait;

    /**
     * @var string The tablename this object maps to
     */
    protected $_objectType = 'route';
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", unique=true)
     * @Assert\Type(type="integer")
     * @Assert\NotNull()
     * @Assert\LessThan(value=1000000000)
     * @var integer $id
     */
    protected $id = 0;
    
    /**
     * the current workflow state
     * @ORM\Column(length=20)
     * @Assert\NotBlank()
     * @RoutesAssert\ListEntry(entityName="route", propertyName="workflowState", multiple=false)
     * @var string $workflowState
     */
    protected $workflowState = 'initial';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @RoutesAssert\ListEntry(entityName="route", propertyName="routeType", multiple=false)
     * @var string $routeType
     */
    protected $routeType = 'additional';
    
    /**
     * @ORM\Column(length=255, nullable=true)
     * @Assert\Length(min="0", max="255")
     * @var string $replacedRouteName
     */
    protected $replacedRouteName = '';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="0", max="255")
     * @var string $bundle
     */
    protected $bundle = '';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="0", max="255")
     * @var string $controller
     */
    protected $controller = '';
    
    /**
     * @ORM\Column(name="route_action", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="0", max="255")
     * @var string $action
     */
    protected $action = '';
    
    /**
     * @ORM\Column(name="route_path", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="0", max="255")
     * @var string $path
     */
    protected $path = '';
    
    /**
     * @ORM\Column(length=255, nullable=true)
     * @Assert\Length(min="0", max="255")
     * @var string $host
     */
    protected $host = '';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @RoutesAssert\ListEntry(entityName="route", propertyName="schemes", multiple=true)
     * @var string $schemes
     */
    protected $schemes = 'http';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @RoutesAssert\ListEntry(entityName="route", propertyName="methods", multiple=true)
     * @var string $methods
     */
    protected $methods = 'GET';
    
    /**
     * @ORM\Column(type="boolean")
     * @Assert\IsTrue(message="This option is mandatory.")
     * @Assert\Type(type="bool")
     * @var boolean $prependBundlePrefix
     */
    protected $prependBundlePrefix = true;
    
    /**
     * @ORM\Column(type="boolean")
     * @Assert\IsTrue(message="This option is mandatory.")
     * @Assert\Type(type="bool")
     * @var boolean $translatable
     */
    protected $translatable = true;
    
    /**
     * @ORM\Column(length=255, nullable=true)
     * @Assert\Length(min="0", max="255")
     * @var string $translationPrefix
     */
    protected $translationPrefix = '';
    
    /**
     * @ORM\Column(name="route_defaults", type="array")
     * @Assert\NotBlank()
     * @Assert\Type(type="array")
     * @var array $defaults
     */
    protected $defaults = [];
    
    /**
     * @ORM\Column(type="array")
     * @Assert\NotNull()
     * @Assert\Type(type="array")
     * @var array $requirements
     */
    protected $requirements = [];
    
    /**
     * @ORM\Column(name="route_condition", length=255, nullable=true)
     * @Assert\Length(min="0", max="255")
     * @var string $condition
     */
    protected $condition = '';
    
    /**
     * @ORM\Column(length=255, nullable=true)
     * @Assert\Length(min="0", max="255")
     * @var string $description
     */
    protected $description = '';
    
    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(type="integer")
     * @Assert\Type(type="integer")
     * @Assert\NotNull()
     * @Assert\LessThan(value=100000000000)
     * @var integer $sort
     */
    protected $sort = 0;
    
    /**
     * @Gedmo\SortableGroup
     * @ORM\Column(name="sort_group", length=255)
     * @Assert\NotNull()
     * @Assert\Length(min="0", max="255")
     * @var string $group
     */
    protected $group = '';
    
    
    
    /**
     * RouteEntity constructor.
     *
     * Will not be called by Doctrine and can therefore be used
     * for own implementation purposes. It is also possible to add
     * arbitrary arguments as with every other class method.
     */
    public function __construct()
    {
    }
    
    /**
     * Returns the _object type.
     *
     * @return string
     */
    public function get_objectType()
    {
        return $this->_objectType;
    }
    
    /**
     * Sets the _object type.
     *
     * @param string $_objectType
     *
     * @return void
     */
    public function set_objectType($_objectType)
    {
        $this->_objectType = $_objectType;
    }
    
    
    /**
     * Returns the id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Sets the id.
     *
     * @param integer $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = intval($id);
    }
    
    /**
     * Returns the workflow state.
     *
     * @return string
     */
    public function getWorkflowState()
    {
        return $this->workflowState;
    }
    
    /**
     * Sets the workflow state.
     *
     * @param string $workflowState
     *
     * @return void
     */
    public function setWorkflowState($workflowState)
    {
        $this->workflowState = isset($workflowState) ? $workflowState : '';
    }
    
    /**
     * Returns the route type.
     *
     * @return string
     */
    public function getRouteType()
    {
        return $this->routeType;
    }
    
    /**
     * Sets the route type.
     *
     * @param string $routeType
     *
     * @return void
     */
    public function setRouteType($routeType)
    {
        $this->routeType = isset($routeType) ? $routeType : '';
    }
    
    /**
     * Returns the replaced route name.
     *
     * @return string
     */
    public function getReplacedRouteName()
    {
        return $this->replacedRouteName;
    }
    
    /**
     * Sets the replaced route name.
     *
     * @param string $replacedRouteName
     *
     * @return void
     */
    public function setReplacedRouteName($replacedRouteName)
    {
        $this->replacedRouteName = $replacedRouteName;
    }
    
    /**
     * Returns the bundle.
     *
     * @return string
     */
    public function getBundle()
    {
        return $this->bundle;
    }
    
    /**
     * Sets the bundle.
     *
     * @param string $bundle
     *
     * @return void
     */
    public function setBundle($bundle)
    {
        $this->bundle = isset($bundle) ? $bundle : '';
    }
    
    /**
     * Returns the controller.
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }
    
    /**
     * Sets the controller.
     *
     * @param string $controller
     *
     * @return void
     */
    public function setController($controller)
    {
        $this->controller = isset($controller) ? $controller : '';
    }
    
    /**
     * Returns the action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
    
    /**
     * Sets the action.
     *
     * @param string $action
     *
     * @return void
     */
    public function setAction($action)
    {
        $this->action = isset($action) ? $action : '';
    }
    
    /**
     * Returns the path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * Sets the path.
     *
     * @param string $path
     *
     * @return void
     */
    public function setPath($path)
    {
        $this->path = isset($path) ? $path : '';
    }
    
    /**
     * Returns the host.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }
    
    /**
     * Sets the host.
     *
     * @param string $host
     *
     * @return void
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
    
    /**
     * Returns the schemes.
     *
     * @return string
     */
    public function getSchemes()
    {
        return $this->schemes;
    }
    
    /**
     * Sets the schemes.
     *
     * @param string $schemes
     *
     * @return void
     */
    public function setSchemes($schemes)
    {
        $this->schemes = isset($schemes) ? $schemes : '';
    }
    
    /**
     * Returns the methods.
     *
     * @return string
     */
    public function getMethods()
    {
        return $this->methods;
    }
    
    /**
     * Sets the methods.
     *
     * @param string $methods
     *
     * @return void
     */
    public function setMethods($methods)
    {
        $this->methods = isset($methods) ? $methods : '';
    }
    
    /**
     * Returns the prepend bundle prefix.
     *
     * @return boolean
     */
    public function getPrependBundlePrefix()
    {
        return $this->prependBundlePrefix;
    }
    
    /**
     * Sets the prepend bundle prefix.
     *
     * @param boolean $prependBundlePrefix
     *
     * @return void
     */
    public function setPrependBundlePrefix($prependBundlePrefix)
    {
        if ($prependBundlePrefix !== $this->prependBundlePrefix) {
            $this->prependBundlePrefix = (bool)$prependBundlePrefix;
        }
    }
    
    /**
     * Returns the translatable.
     *
     * @return boolean
     */
    public function getTranslatable()
    {
        return $this->translatable;
    }
    
    /**
     * Sets the translatable.
     *
     * @param boolean $translatable
     *
     * @return void
     */
    public function setTranslatable($translatable)
    {
        if ($translatable !== $this->translatable) {
            $this->translatable = (bool)$translatable;
        }
    }
    
    /**
     * Returns the translation prefix.
     *
     * @return string
     */
    public function getTranslationPrefix()
    {
        return $this->translationPrefix;
    }
    
    /**
     * Sets the translation prefix.
     *
     * @param string $translationPrefix
     *
     * @return void
     */
    public function setTranslationPrefix($translationPrefix)
    {
        $this->translationPrefix = $translationPrefix;
    }
    
    /**
     * Returns the defaults.
     *
     * @return array
     */
    public function getDefaults()
    {
        return $this->defaults;
    }
    
    /**
     * Sets the defaults.
     *
     * @param array $defaults
     *
     * @return void
     */
    public function setDefaults($defaults)
    {
        $this->defaults = isset($defaults) ? $defaults : '';
    }
    
    /**
     * Returns the requirements.
     *
     * @return array
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
    
    /**
     * Sets the requirements.
     *
     * @param array $requirements
     *
     * @return void
     */
    public function setRequirements($requirements)
    {
        $this->requirements = isset($requirements) ? $requirements : '';
    }
    
    /**
     * Returns the condition.
     *
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * Sets the condition.
     *
     * @param string $condition
     *
     * @return void
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }
    
    /**
     * Returns the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description.
     *
     * @param string $description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Returns the sort.
     *
     * @return integer
     */
    public function getSort()
    {
        return $this->sort;
    }
    
    /**
     * Sets the sort.
     *
     * @param integer $sort
     *
     * @return void
     */
    public function setSort($sort)
    {
        $this->sort = intval($sort);
    }
    
    /**
     * Returns the group.
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    /**
     * Sets the group.
     *
     * @param string $group
     *
     * @return void
     */
    public function setGroup($group)
    {
        $this->group = isset($group) ? $group : '';
    }
    
    
    
    /**
     * Returns the formatted title conforming to the display pattern
     * specified for this entity.
     *
     * @return string The display title
     */
    public function getTitleFromDisplayPattern()
    {
        $formattedTitle = ''
                . $this->getPath()
                . ' ('
                . $this->getSort()
                . ')';
    
        return $formattedTitle;
    }
    
    /**
     * Return entity data in JSON format.
     *
     * @return string JSON-encoded data
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }
    
    /**
     * Creates url arguments array for easy creation of display urls.
     *
     * @return array The resulting arguments list
     */
    public function createUrlArgs()
    {
        $args = [];
    
        $args['id'] = $this['id'];
    
        if (property_exists($this, 'slug')) {
            $args['slug'] = $this['slug'];
        }
    
        return $args;
    }
    
    /**
     * Create concatenated identifier string (for composite keys).
     *
     * @return String concatenated identifiers
     */
    public function createCompositeIdentifier()
    {
        $itemId = $this['id'];
    
        return $itemId;
    }
    
    /**
     * Determines whether this entity supports hook subscribers or not.
     *
     * @return boolean
     */
    public function supportsHookSubscribers()
    {
        return false;
    }
    
    /**
     * Returns an array of all related objects that need to be persisted after clone.
     * 
     * @param array $objects The objects are added to this array. Default: []
     * 
     * @return array of entity objects
     */
    public function getRelatedObjectsToPersist(&$objects = []) 
    {
        return [];
    }
    
    /**
     * ToString interceptor implementation.
     * This method is useful for debugging purposes.
     *
     * @return string The output string for this entity
     */
    public function __toString()
    {
        return 'Route ' . $this->createCompositeIdentifier() . ': ' . $this->getTitleFromDisplayPattern();
    }
    
    /**
     * Clone interceptor implementation.
     * This method is for example called by the reuse functionality.
     * Performs a quite simple shallow copy.
     *
     * See also:
     * (1) http://docs.doctrine-project.org/en/latest/cookbook/implementing-wakeup-or-clone.html
     * (2) http://www.php.net/manual/en/language.oop5.cloning.php
     * (3) http://stackoverflow.com/questions/185934/how-do-i-create-a-copy-of-an-object-in-php
     */
    public function __clone()
    {
        // if the entity has no identity do nothing, do NOT throw an exception
        if (!($this->id)) {
            return;
        }
    
        // otherwise proceed
    
        // unset identifiers
        $this->setId(0);
    
        $this->setCreatedBy(null);
        $this->setCreatedDate(null);
        $this->setUpdatedBy(null);
        $this->setUpdatedDate(null);
    
    }
}
