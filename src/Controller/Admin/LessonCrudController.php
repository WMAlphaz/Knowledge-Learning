<?php

namespace App\Controller\Admin;

use App\Entity\Cursus;
use App\Entity\Lesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;

class LessonCrudController extends AbstractCrudController
{
    use  Trait\ReadOnlyTrait;
    
    public static function getEntityFqcn(): string
    {
        return Lesson::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id_lesson')
                ->onlyOnIndex(),
            TextField::new('name_lesson'),
            MoneyField::new('price')
                ->setCurrency('EUR')
                ->setStoredAsCents(false),
            TextareaField::new('content'),
            
            ImageField::new('video_url')
                ->setUploadDir('public/assets/uploads/videos')
                ->setBasePath('/uploads/videos')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFileConstraints([
                    new File([
                        'maxSize' => '100M',               
                        'mimeTypes' => [
                            'video/mp4',                 
                        ],
                        'mimeTypesMessage' => 'Veuillez importer une vidéo au format MP4.',
                        'maxSizeMessage' => 'Merci de sélectionner une vidéo au format valide, d\'une taille maximale de 100 Mo.'
                    ]),
                ])
                ->setRequired(false),
            TextField::new('description'),

            AssociationField::new('cursus')
                ->setCrudController(CursusCrudController::class)
                ->setLabel('Cursus')
                ->setFormTypeOptions(['placeholder' => 'Veuillez sélectionner un cursus ']),

            ImageField::new('certificationImage')
                ->setUploadDir('public/assets/uploads/images/certification')
                ->setBasePath('/uploads/images/certification')
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
                
            DateTimeField::new('createdAt', 'Enregistré le ')
                ->onlyOnIndex(),
            DateTimeField::new('updatedAt', 'Modifié le')
                ->onlyOnIndex(),

            
            
        ];
    }

}
