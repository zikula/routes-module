<?php
/**
 * Routes.
 *
 * @copyright Zikula contributors (Zikula)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @author Zikula contributors <info@ziku.la>.
 * @link https://ziku.la
 * @version Generated by ModuleStudio 1.4.0 (https://modulestudio.de).
 */

namespace Zikula\RoutesModule\Form\Type\Field\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Zikula\RoutesModule\Form\DataTransformer\ListFieldTransformer;
use Zikula\RoutesModule\Helper\ListEntriesHelper;

/**
 * Multi list field type base class.
 */
abstract class AbstractMultiListType extends AbstractType
{
    /**
     * @var ListEntriesHelper
     */
    protected $listHelper;

    /**
     * MultiListType constructor.
     *
     * @param ListEntriesHelper $listHelper
     */
    public function __construct(ListEntriesHelper $listHelper)
    {
        $this->listHelper = $listHelper;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ListFieldTransformer($this->listHelper);
        $builder->addModelTransformer($transformer);
    }

    /**
     * @inheritDoc
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        return 'zikularoutesmodule_field_multilist';
    }
}
