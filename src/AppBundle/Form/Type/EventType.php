<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title', 'text', array(
				'label' => '标题',
			))
			->add('orderId', 'text', array(
				'label' => '排序(从大到小)',
			))
			->add('subTitle', 'text', array(
				'label' => '副标题',
				'required' => false,
			))
			->add('info', 'textarea', array(
				'label' => '内容',
				'attr' => array('class' => 'tinymce','data-theme' => 'advanced','style'=>'min-height:400px;'),
			))
			->add('imgUrl', 'file', array(
				'label' => '图片',
				'data_class' => null,
				'required' => false,
				'attr' => array('value' => $builder->getData()->getImgUrl(),'class'=>'preview')
			))
			->add('save', 'submit', array('label' => '保存'))
		;
	}
	public function getName()
	{
		return 'event';
	}
}