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

namespace Zikula\RoutesModule\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Zikula\ExtensionsModule\Constant as ExtensionConstant;
use Zikula\ExtensionsModule\Entity\ExtensionEntity;
use Zikula\ExtensionsModule\Entity\RepositoryInterface\ExtensionRepositoryInterface;
use Zikula\RoutesModule\Form\Type\Base\AbstractRouteType;

/**
 * Route editing form type implementation class.
 */
class RouteType extends AbstractRouteType
{
    /**
     * @var ExtensionRepositoryInterface
     */
    private $extensionRepository;

    /**
     * @param ExtensionRepositoryInterface $extensionRepository
     */
    public function setExtensionRepository(ExtensionRepositoryInterface $extensionRepository)
    {
        $this->extensionRepository = $extensionRepository;
    }

    /**
     * @inheritDoc
     */
    public function addEntityFields(FormBuilderInterface $builder, array $options)
    {
        parent::addEntityFields($builder, $options);

        // note we just read fields which already had been added in the parent class
        // FormBuilder just overrides the field allowing us easier customisation

        $moduleChoices = [];
        $moduleChoiceAttributes = [];
        /** @var ExtensionEntity[] $modules */
        $modules = $this->extensionRepository->findBy(['state' => ExtensionConstant::STATE_ACTIVE]);
        foreach ($modules as $module) {
            $moduleChoices[$module->getDisplayName()] = $module->getName();
            $moduleChoiceAttributes[$module->getDisplayName()] = ['title' => $module->getDisplayName()];
        }
        ksort($moduleChoices);

        $builder->add('bundle', ChoiceType::class, [
            'label' => $this->__('Bundle') . ':',
            'empty_data' => '',
            'attr' => [
                'class' => '',
                'title' => $this->__('Enter the bundle of the route')
            ],
            'required' => true,
            'choices' => $moduleChoices,
            'choices_as_values' => true,
            'choice_attr' => $moduleChoiceAttributes,
            'multiple' => false,
            'expanded' => false
        ]);

        $builder->add('controller', TextType::class, [
            'label' => $this->__('Controller') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the controller of the route')
            ],
            'required' => true,
            'help' => $this->__('Insert the name of the controller, which was called "type" in earlier versions of Zikula.')
        ]);

        $builder->add('action', TextType::class, [
            'label' => $this->__('Action') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the action of the route')
            ],
            'required' => true,
            'help' => $this->__('Insert the name of the action, which was called "func" in earlier versions of Zikula.')
        ]);

        $builder->add('path', TextType::class, [
            'label' => $this->__('Path') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the path of the route')
            ],
            'required' => true,
            'help' => $this->__('The path must start with a "/" and can be a regular expression. Example: "/login"'),
            'input_group' => ['left' => '<span id="pathPrefix"></span>']
        ]);

        $builder->add('host', TextType::class, [
            'label' => $this->__('Host') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the host of the route')
            ],
            'required' => false,
            'help' => $this->__f('Advanced setting, see %s', ['%s' => 'https://symfony.com/doc/current/routing/hostname_pattern.html'])
        ]);

        $builder->add('condition', TextType::class, [
            'label' => $this->__('Condition') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the condition of the route')
            ],
            'required' => false,
            'help' => $this->__f('Advanced setting, see %s', ['%s' => 'https://symfony.com/doc/current/routing/conditions.html'])
        ]);

        $builder->add('description', TextType::class, [
            'label' => $this->__('Description') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the description of the route')
            ],
            'required' => false,
            'help' => $this->__('Insert a brief description of the route, to explain why you created it. It is only shown in the admin interface.')
        ]);
    }
}
