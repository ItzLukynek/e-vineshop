<?php
namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Jméno',
                'attr' => ['placeholder' => 'Zde vyplňte Vaše jméno'],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Příjmení',
                'attr' => ['placeholder' => 'Zde vyplňte Vaše příjmení'],
            ])
            ->add('email', TextType::class, [
                'label' => 'E-mail',
                'attr' => ['placeholder' => 'Zde vyplňte Váš email'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telefon',
                'attr' => ['placeholder' => '+420 XXX XXX XXX'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Popis objednávky',
                'attr' => ['placeholder' => 'Zde popište jaký typ balíčku by jste chtěl/a, pro koho to je a co do balíčku.'],
            ])
            ->add('specialNotes', TextareaType::class, [
                'label' => 'Alergie',
                'required' => false,
                'attr' => ['placeholder' => 'Zde popište co by jste nechtěl/a v balíčku. Nebo napište alergie'],

            ])
            ->add('minPrice', IntegerType::class, [
                'required' => false,
                'label' => 'Minimální cena',
                'attr' => ['placeholder' => 'Menší balíčky začínají na 800KČ, střední 1500Kč a závisí na typu balení'],
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => 'Maximální cena',
                'attr' => ['placeholder' => 'Bez limitu :)'],

            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
