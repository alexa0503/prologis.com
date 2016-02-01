<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('password', 'password', array(
				'label' => '新密码',
				'required' => true,
			))
			->add('save', 'submit', array('label' => '保存'))
		;
	}
	public function getName()
	{
		return 'user';
	}
}