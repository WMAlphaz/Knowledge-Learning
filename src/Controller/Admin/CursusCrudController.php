<?php

namespace App\Controller\Admin;

use App\Entity\Cursus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;

class CursusCrudController extends AbstractCrudController
{
    use  Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Cursus::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id_cursus')
                ->onlyOnIndex(),
            TextField::new('name_cursus'),
            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),
            AssociationField::new('theme')
                ->setCrudController(ThemeCrudController::class)
                ->setLabel('Thème')
                ->setFormTypeOptions(['placeholder' => 'Choisissez un thème ']),

            ImageField::new('images')
                ->setUploadDir('public/assets/uploads/images')
                ->setBasePath('/uploads/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFileConstraints([
                    new File([
                        'maxSize' => '100M',               
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',                 
                        ],
                        'mimeTypesMessage' => 'Veuillez importer une image au format JPG, JPEG ou PNG.',
                        'maxSizeMessage' => 'Merci de sélectionner une image au format valide, d\'une taille maximale de 100 Mo.'
                    ]),
                ])
                ->setRequired(false),
            TextField::new('description'),
            
            CollectionField::new('lesson')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            DateTimeField::new('createdAt', 'Enregistré le')
                ->hideOnForm()
                ->hideWhenCreating(),
            DateTimeField::new('updatedAt', 'Modifié le')
                ->hideOnForm()
                ->hideWhenCreating(),
        ];
    }
    
}
