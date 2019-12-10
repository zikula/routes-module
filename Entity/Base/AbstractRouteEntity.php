<?php

declare(strict_types=1);

/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <info@ziku.la>.
 * @link https://ziku.la
 * @version Generated by ModuleStudio 1.4.0 (https://modulestudio.de).
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
     * @var int $id
     */
    protected $id = 0;
    
    /**
     * the current workflow state
     *
     * @ORM\Column(length=20)
     * @Assert\NotBlank()
     * @RoutesAssert\ListEntry(entityName="route", propertyName="workflowState", multiple=false)
     * @var string $workflowState
     */
    protected $workflowState = 'initial';
    
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
    protected $schemes = 'http###https';
    
    /**
     * @ORM\Column(length=255)
     * @Assert\NotBlank()
     * @RoutesAssert\ListEntry(entityName="route", propertyName="methods", multiple=true)
     * @var string $methods
     */
    protected $methods = 'GET';
    
    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type(type="bool")
     * @var bool $prependBundlePrefix
     */
    protected $prependBundlePrefix = true;
    
    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type(type="bool")
     * @var bool $translatable
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
     * @Assert\NotNull()
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
     * @ORM\Column(type="array")
     * @Assert\NotNull()
     * @Assert\Type(type="array")
     * @var array $options
     */
    protected $options = [];
    
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
     * @var int $sort
     */
    protected $sort = 0;
    
    
    
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
    
    public function get_objectType(): string
    {
        return $this->_objectType;
    }
    
    public function set_objectType(string $_objectType): void
    {
        if ($this->_objectType !== $_objectType) {
            $this->_objectType = $_objectType ?? '';
        }
    }
    
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(int $id = null): void
    {
        if ((int)$this->id !== $id) {
            $this->id = $id;
        }
    }
    
    public function getWorkflowState(): string
    {
        return $this->workflowState;
    }
    
    public function setWorkflowState(string $workflowState): void
    {
        if ($this->workflowState !== $workflowState) {
            $this->workflowState = $workflowState ?? '';
        }
    }
    
    public function getBundle(): string
    {
        return $this->bundle;
    }
    
    public function setBundle(string $bundle): void
    {
        if ($this->bundle !== $bundle) {
            $this->bundle = $bundle ?? '';
        }
    }
    
    public function getController(): string
    {
        return $this->controller;
    }
    
    public function setController(string $controller): void
    {
        if ($this->controller !== $controller) {
            $this->controller = $controller ?? '';
        }
    }
    
    public function getAction(): string
    {
        return $this->action;
    }
    
    public function setAction(string $action): void
    {
        if ($this->action !== $action) {
            $this->action = $action ?? '';
        }
    }
    
    public function getPath(): string
    {
        return $this->path;
    }
    
    public function setPath(string $path): void
    {
        if ($this->path !== $path) {
            $this->path = $path ?? '';
        }
    }
    
    public function getHost(): ?string
    {
        return $this->host;
    }
    
    public function setHost(string $host = null): void
    {
        if ($this->host !== $host) {
            $this->host = $host;
        }
    }
    
    public function getSchemes(): string
    {
        return $this->schemes;
    }
    
    public function setSchemes(string $schemes): void
    {
        if ($this->schemes !== $schemes) {
            $this->schemes = $schemes ?? '';
        }
    }
    
    public function getMethods(): string
    {
        return $this->methods;
    }
    
    public function setMethods(string $methods): void
    {
        if ($this->methods !== $methods) {
            $this->methods = $methods ?? '';
        }
    }
    
    public function getPrependBundlePrefix(): bool
    {
        return $this->prependBundlePrefix;
    }
    
    public function setPrependBundlePrefix(bool $prependBundlePrefix): void
    {
        if ((bool)$this->prependBundlePrefix !== $prependBundlePrefix) {
            $this->prependBundlePrefix = $prependBundlePrefix;
        }
    }
    
    public function getTranslatable(): bool
    {
        return $this->translatable;
    }
    
    public function setTranslatable(bool $translatable): void
    {
        if ((bool)$this->translatable !== $translatable) {
            $this->translatable = $translatable;
        }
    }
    
    public function getTranslationPrefix(): ?string
    {
        return $this->translationPrefix;
    }
    
    public function setTranslationPrefix(string $translationPrefix = null): void
    {
        if ($this->translationPrefix !== $translationPrefix) {
            $this->translationPrefix = $translationPrefix;
        }
    }
    
    public function getDefaults(): array
    {
        return $this->defaults;
    }
    
    public function setDefaults(array $defaults): void
    {
        if ($this->defaults !== $defaults) {
            $this->defaults = $defaults ?? [];
        }
    }
    
    public function getRequirements(): array
    {
        return $this->requirements;
    }
    
    public function setRequirements(array $requirements): void
    {
        if ($this->requirements !== $requirements) {
            $this->requirements = $requirements ?? [];
        }
    }
    
    public function getOptions(): array
    {
        return $this->options;
    }
    
    public function setOptions(array $options): void
    {
        if ($this->options !== $options) {
            $this->options = $options ?? [];
        }
    }
    
    public function getCondition(): ?string
    {
        return $this->condition;
    }
    
    public function setCondition(string $condition = null): void
    {
        if ($this->condition !== $condition) {
            $this->condition = $condition;
        }
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    public function setDescription(string $description = null): void
    {
        if ($this->description !== $description) {
            $this->description = $description;
        }
    }
    
    public function getSort(): int
    {
        return $this->sort;
    }
    
    public function setSort(int $sort): void
    {
        if ((int)$this->sort !== $sort) {
            $this->sort = $sort;
        }
    }
    
    
    
    
    /**
     * Creates url arguments array for easy creation of display urls.
     */
    public function createUrlArgs(): array
    {
        return [
            'id' => $this->getId()
        ];
    }
    
    /**
     * Returns the primary key.
     */
    public function getKey(): ?int
    {
        return $this->getId();
    }
    
    /**
     * Returns an array of all related objects that need to be persisted after clone.
     */
    public function getRelatedObjectsToPersist(array &$objects = []): array
    {
        return [];
    }
    
    /**
     * ToString interceptor implementation.
     * This method is useful for debugging purposes.
     */
    public function __toString(): string
    {
        return 'Route ' . $this->getKey() . ': ' . $this->getBundle();
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
        if (!$this->id) {
            return;
        }
    
        // otherwise proceed
    
        // unset identifier
        $this->setId(0);
    
        // reset workflow
        $this->setWorkflowState('initial');
    
        $this->setCreatedBy(null);
        $this->setCreatedDate(null);
        $this->setUpdatedBy(null);
        $this->setUpdatedDate(null);
    
    }
}
