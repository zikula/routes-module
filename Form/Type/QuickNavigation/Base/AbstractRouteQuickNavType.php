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

namespace Zikula\RoutesModule\Form\Type\QuickNavigation\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Zikula\Common\Translator\TranslatorTrait;
use Zikula\RoutesModule\Form\Type\Field\MultiListType;
use Zikula\RoutesModule\Helper\ListEntriesHelper;

/**
 * Route quick navigation form type base class.
 */
abstract class AbstractRouteQuickNavType extends AbstractType
{
    use TranslatorTrait;

    /**
     * @var ListEntriesHelper
     */
    protected $listHelper;

    public function __construct(
        TranslatorInterface $translator,
        ListEntriesHelper $listHelper
    ) {
        $this->setTranslator($translator);
        $this->listHelper = $listHelper;
    }

    public function setTranslator(TranslatorInterface $translator): void
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('all', HiddenType::class)
            ->add('own', HiddenType::class)
            ->add('tpl', HiddenType::class)
        ;

        $this->addListFields($builder, $options);
        $this->addSearchField($builder, $options);
        $this->addSortingFields($builder, $options);
        $this->addAmountField($builder, $options);
        $this->addBooleanFields($builder, $options);
        $builder->add('updateview', SubmitType::class, [
            'label' => $this->trans('OK'),
            'attr' => [
                'class' => 'btn btn-default btn-sm'
            ]
        ]);
    }

    /**
     * Adds list fields.
     */
    public function addListFields(FormBuilderInterface $builder, array $options = []): void
    {
        $listEntries = $this->listHelper->getEntries('route', 'workflowState');
        $choices = [];
        $choiceAttributes = [];
        foreach ($listEntries as $entry) {
            $choices[$entry['text']] = $entry['value'];
            $choiceAttributes[$entry['text']] = ['title' => $entry['title']];
        }
        $builder->add('workflowState', ChoiceType::class, [
            'label' => $this->trans('State'),
            'attr' => [
                'class' => 'form-control-sm'
            ],
            'required' => false,
            'placeholder' => $this->trans('All'),
            'choices' => $choices,
            'choice_attr' => $choiceAttributes,
            'multiple' => false,
            'expanded' => false
        ]);
        $listEntries = $this->listHelper->getEntries('route', 'schemes');
        $choices = [];
        $choiceAttributes = [];
        foreach ($listEntries as $entry) {
            $choices[$entry['text']] = $entry['value'];
            $choiceAttributes[$entry['text']] = ['title' => $entry['title']];
        }
        $builder->add('schemes', MultiListType::class, [
            'label' => $this->trans('Schemes'),
            'attr' => [
                'class' => 'form-control-sm'
            ],
            'required' => false,
            'placeholder' => $this->trans('All'),
            'choices' => $choices,
            'choice_attr' => $choiceAttributes,
            'multiple' => true,
            'expanded' => false
        ]);
        $listEntries = $this->listHelper->getEntries('route', 'methods');
        $choices = [];
        $choiceAttributes = [];
        foreach ($listEntries as $entry) {
            $choices[$entry['text']] = $entry['value'];
            $choiceAttributes[$entry['text']] = ['title' => $entry['title']];
        }
        $builder->add('methods', MultiListType::class, [
            'label' => $this->trans('Methods'),
            'attr' => [
                'class' => 'form-control-sm'
            ],
            'required' => false,
            'placeholder' => $this->trans('All'),
            'choices' => $choices,
            'choice_attr' => $choiceAttributes,
            'multiple' => true,
            'expanded' => false
        ]);
    }

    /**
     * Adds a search field.
     */
    public function addSearchField(FormBuilderInterface $builder, array $options = []): void
    {
        $builder->add('q', SearchType::class, [
            'label' => $this->trans('Search'),
            'attr' => [
                'maxlength' => 255,
                'class' => 'form-control-sm'
            ],
            'required' => false
        ]);
    }


    /**
     * Adds sorting fields.
     */
    public function addSortingFields(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('sort', ChoiceType::class, [
                'label' => $this->trans('Sort by'),
                'attr' => [
                    'class' => 'form-control-sm'
                ],
                'choices' =>             [
                    $this->trans('Bundle') => 'bundle',
                    $this->trans('Controller') => 'controller',
                    $this->trans('Action') => 'action',
                    $this->trans('Path') => 'path',
                    $this->trans('Host') => 'host',
                    $this->trans('Schemes') => 'schemes',
                    $this->trans('Methods') => 'methods',
                    $this->trans('Prepend bundle prefix') => 'prependBundlePrefix',
                    $this->trans('Translatable') => 'translatable',
                    $this->trans('Translation prefix') => 'translationPrefix',
                    $this->trans('Condition') => 'condition',
                    $this->trans('Description') => 'description',
                    $this->trans('Sort') => 'sort',
                    $this->trans('Creation date') => 'createdDate',
                    $this->trans('Creator') => 'createdBy',
                    $this->trans('Update date') => 'updatedDate',
                    $this->trans('Updater') => 'updatedBy'
                ],
                'required' => true,
                'expanded' => false
            ])
            ->add('sortdir', ChoiceType::class, [
                'label' => $this->trans('Sort direction'),
                'empty_data' => 'asc',
                'attr' => [
                    'class' => 'form-control-sm'
                ],
                'choices' => [
                    $this->trans('Ascending') => 'asc',
                    $this->trans('Descending') => 'desc'
                ],
                'required' => true,
                'expanded' => false
            ])
        ;
    }

    /**
     * Adds a page size field.
     */
    public function addAmountField(FormBuilderInterface $builder, array $options = []): void
    {
        $builder->add('num', ChoiceType::class, [
            'label' => $this->trans('Page size'),
            'empty_data' => 20,
            'attr' => [
                'class' => 'form-control-sm text-right'
            ],
            'choices' => [
                5 => 5,
                10 => 10,
                15 => 15,
                20 => 20,
                30 => 30,
                50 => 50,
                100 => 100
            ],
            'required' => false,
            'expanded' => false
        ]);
    }

    /**
     * Adds boolean fields.
     */
    public function addBooleanFields(FormBuilderInterface $builder, array $options = []): void
    {
        $builder->add('prependBundlePrefix', ChoiceType::class, [
            'label' => $this->trans('Prepend bundle prefix'),
            'attr' => [
                'class' => 'form-control-sm'
            ],
            'required' => false,
            'placeholder' => $this->trans('All'),
            'choices' => [
                $this->trans('No') => 'no',
                $this->trans('Yes') => 'yes'
            ]
        ]);
        $builder->add('translatable', ChoiceType::class, [
            'label' => $this->trans('Translatable'),
            'attr' => [
                'class' => 'form-control-sm'
            ],
            'required' => false,
            'placeholder' => $this->trans('All'),
            'choices' => [
                $this->trans('No') => 'no',
                $this->trans('Yes') => 'yes'
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'zikularoutesmodule_routequicknav';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }
}
