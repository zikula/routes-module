<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <support@zikula.org>.
 * @link http://www.zikula.org
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.1 (http://modulestudio.de).
 */

namespace Zikula\RoutesModule\Form\Type;

use ModUtil;
use Symfony\Component\Form\FormBuilderInterface;
use Zikula\RoutesModule\Form\Type\Base\AbstractRouteType;

/**
 * Route editing form type implementation class.
 */
class RouteType extends AbstractRouteType
{
    /**
     * {@inheritdoc}
     */
    public function addEntityFields(FormBuilderInterface $builder, array $options)
    {
        parent::addEntityFields($builder, $options);

        // note we just readd fields which already had been added in the parent class
        // FormBuilder just overrides the field allowing us easier customisation

        $moduleChoices = [];
        $moduleChoiceAttributes = [];
        $modules = ModUtil::getModulesByState(3, 'displayname');
        foreach ($modules as $module) {
            $moduleChoices[$module['displayname']] = $module['name'];
            $moduleChoiceAttributes[$module['displayname']] = ['title' => $module['displayname']];
        }

        $builder->add('bundle', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', [
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

        $builder->add('controller', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
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

        $builder->add('action', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
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

        $builder->add('path', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
            'label' => $this->__('Path') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the path of the route')
            ],
            'required' => true,
            'help' => $this->__('The path must start with a "/" and can be a regular expression. Example: "/login"'),
            'input_group' => ['left' => '<span class="input-group-addon" id="pathPrefix"></span>']
        ]);

        $builder->add('host', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
            'label' => $this->__('Host') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the host of the route')
            ],
            'required' => false,
            'help' => $this->__f('Advanced setting, see %s', ['%s' => 'http://symfony.com/doc/current/components/routing/hostname_pattern.html'])
        ]);

        $builder->add('condition', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
            'label' => $this->__('Condition') . ':',
            'empty_data' => '',
            'attr' => [
                'maxlength' => 255,
                'class' => '',
                'title' => $this->__('Enter the condition of the route')
            ],
            'required' => false,
            'help' => $this->__f('Advanced setting, see %s', ['%s' => 'http://symfony.com/doc/current/book/routing.html#completely-customized-route-matching-with-conditions'])
        ]);

        $builder->add('description', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
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
