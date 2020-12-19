<?php

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Genetics
        Permission::create([
            'name'        => 'Navegar genéticas',
            'slug'        => 'genetics.index',
            'description' => 'Lista y navega todas las genéticas del sistema',
        ]);
        Permission::create([
            'name'        => 'Registro de genéticas',
            'slug'        => 'genetics.create',
            'description' => 'Podría registrar nuevas genéticas en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de genéticas',
            'slug'        => 'genetics.edit',
            'description' => 'Podría editar cualquier dato de una genética del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar genética',
            'slug'        => 'genetics.destroy',
            'description' => 'Podría eliminar cualquier genética del sistema',
        ]);

        //Phases
        Permission::create([
            'name'        => 'Navegar fases',
            'slug'        => 'phases.index',
            'description' => 'Lista y navega todas las fases del sistema',
        ]);
        Permission::create([
            'name'        => 'Registro de fases',
            'slug'        => 'phases.create',
            'description' => 'Podría registrar nuevas fases en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de fases',
            'slug'        => 'phases.edit',
            'description' => 'Podría editar cualquier dato de una fase del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar fase',
            'slug'        => 'phases.destroy',
            'description' => 'Podría eliminar cualquier fase del sistema',
        ]);

        //Locations
        Permission::create([
            'name'        => 'Navegar ubicaciones',
            'slug'        => 'locations.index',
            'description' => 'Lista y navega todas las ubicaciones del sistema',
        ]);
        Permission::create([
            'name'        => 'Registro de ubicaciones',
            'slug'        => 'locations.create',
            'description' => 'Podría registrar nuevas ubicaciones en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de ubicaciones',
            'slug'        => 'locations.edit',
            'description' => 'Podría editar cualquier dato de una ubicación del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar ubicación',
            'slug'        => 'locations.destroy',
            'description' => 'Podría eliminar cualquier ubicación del sistema',
        ]);

        //Reproducers
        Permission::create([
            'name'        => 'Navegar reproductoras',
            'slug'        => 'females.index',
            'description' => 'Lista y navega todas las reproductoras del sistema',
        ]);
        Permission::create([
            'name'        => 'Registro de reproductoras',
            'slug'        => 'females.create',
            'description' => 'Podría registrar nuevas reproductoras en el sistema',
        ]);
        Permission::create([
            'name'        => 'Ver detalle de reproductoras',
            'slug'        => 'females.show',
            'description' => 'Ve en detalle cada reproductora del sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de reproductoras',
            'slug'        => 'females.edit',
            'description' => 'Podría editar cualquier dato de una reproductora del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar reproductora',
            'slug'        => 'females.destroy',
            'description' => 'Podría eliminar cualquier reproductora del sistema',
        ]);

        //Inseminations
        Permission::create([
            'name'        => 'Registro de inseminaciones',
            'slug'        => 'inseminations.create',
            'description' => 'Podría registrar nuevas inseminaciones en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de inseminaciones',
            'slug'        => 'inseminations.edit',
            'description' => 'Podría editar cualquier dato de una inseminación del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar inseminación',
            'slug'        => 'inseminations.destroy',
            'description' => 'Podría eliminar cualquier inseminación del sistema',
        ]);

        //Adoptions
        Permission::create([
            'name'        => 'Registro de adopciones',
            'slug'        => 'adoptions.create',
            'description' => 'Podría registrar nuevas adopciones en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de adopciones',
            'slug'        => 'adoptions.edit',
            'description' => 'Podría editar cualquier dato de una adopción del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar adopción',
            'slug'        => 'adoptions.destroy',
            'description' => 'Podría eliminar cualquier adopción del sistema',
        ]);

        //Transfers
        Permission::create([
            'name'        => 'Registro de traslados',
            'slug'        => 'transfers.create',
            'description' => 'Podría registrar nuevos traslados en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de traslados',
            'slug'        => 'transfers.edit',
            'description' => 'Podría editar cualquier dato de un traslado del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar traslado',
            'slug'        => 'transfers.destroy',
            'description' => 'Podría eliminar cualquier traslado del sistema',
        ]);

        //Extractions
        Permission::create([
            'name'        => 'Registro de extracciones',
            'slug'        => 'extractions.create',
            'description' => 'Podría registrar nuevas extracciones en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de extracciones',
            'slug'        => 'extractions.edit',
            'description' => 'Podría editar cualquier dato de una extracción del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar extracción',
            'slug'        => 'extractions.destroy',
            'description' => 'Podría eliminar cualquier extracción del sistema',
        ]);

        //Semen
        Permission::create([
            'name'        => 'Registro de semen',
            'slug'        => 'semen.create',
            'description' => 'Podría registrar nuevos semen en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de semen',
            'slug'        => 'semen.edit',
            'description' => 'Podría editar cualquier dato de un semen del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar semen',
            'slug'        => 'semen.destroy',
            'description' => 'Podría eliminar cualquier semen del sistema',
        ]);

        //Weanings
        Permission::create([
            'name'        => 'Registro de destetes',
            'slug'        => 'weanings.create',
            'description' => 'Podría registrar nuevos destetes en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de destetes',
            'slug'        => 'weanings.edit',
            'description' => 'Podría editar cualquier dato de un destete del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar destete',
            'slug'        => 'weanings.destroy',
            'description' => 'Podría eliminar cualquier destete del sistema',
        ]);

        //Abortions
        Permission::create([
            'name'        => 'Registro de abortos',
            'slug'        => 'abortions.create',
            'description' => 'Podría registrar nuevos abortos en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de abortos',
            'slug'        => 'abortions.edit',
            'description' => 'Podría editar cualquier dato de un aborto del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar aborto',
            'slug'        => 'abortions.destroy',
            'description' => 'Podría eliminar cualquier aborto del sistema',
        ]);

        //Deaths
        Permission::create([
            'name'        => 'Registro de muertes',
            'slug'        => 'deaths.create',
            'description' => 'Podría registrar nuevas muertes en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de muertes',
            'slug'        => 'deaths.edit',
            'description' => 'Podría editar cualquier dato de una muerte del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar muerte',
            'slug'        => 'deaths.destroy',
            'description' => 'Podría eliminar cualquier muerte del sistema',
        ]);

        //DeathsBreeding
        Permission::create([
            'name'        => 'Registro de muertes lactantes',
            'slug'        => 'deathsbreeding.create',
            'description' => 'Podría registrar nuevas muertes lactantes en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de muertes lactantes',
            'slug'        => 'deathsbreeding.edit',
            'description' => 'Podría editar cualquier dato de una muerte lactante del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar muerte lactante',
            'slug'        => 'deathsbreeding.destroy',
            'description' => 'Podría eliminar cualquier muerte lactante del sistema',
        ]);

        //Births
        Permission::create([
            'name'        => 'Registro de partos',
            'slug'        => 'births.create',
            'description' => 'Podría registrar nuevos partos en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de partos',
            'slug'        => 'births.edit',
            'description' => 'Podría editar cualquier dato de un parto del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar parto',
            'slug'        => 'births.destroy',
            'description' => 'Podría eliminar cualquier parto del sistema',
        ]);

        //Treatments
        Permission::create([
            'name'        => 'Registro de tratamientos',
            'slug'        => 'treatments.create',
            'description' => 'Podría registrar nuevos tratamientos en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de tratamientos',
            'slug'        => 'treatments.edit',
            'description' => 'Podría editar cualquier dato de un tratamiento del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar tratamiento',
            'slug'        => 'treatments.destroy',
            'description' => 'Podría eliminar cualquier tratamiento del sistema',
        ]);

        //Groups
        Permission::create([
            'name'        => 'Registro de grupos',
            'slug'        => 'groups.create',
            'description' => 'Podría registrar nuevos grupos en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de grupos',
            'slug'        => 'groups.edit',
            'description' => 'Podría editar cualquier dato de un grupo del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar grupo',
            'slug'        => 'groups.destroy',
            'description' => 'Podría eliminar cualquier grupo del sistema',
        ]);

        //GroupTreatments
        Permission::create([
            'name'        => 'Registro de tratamientos a grupo',
            'slug'        => 'grouptreatments.create',
            'description' => 'Podría registrar nuevos tratamientos a grupo en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de tratamientos a grupo',
            'slug'        => 'grouptreatments.edit',
            'description' => 'Podría editar cualquier dato de un tratamiento a grupo del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar tratamiento a grupo',
            'slug'        => 'grouptreatments.destroy',
            'description' => 'Podría eliminar cualquier tratamineto a grupo del sistema',
        ]);

        //DeathsGroup
        Permission::create([
            'name'        => 'Registro de muertes del grupo',
            'slug'        => 'deathsgroup.create',
            'description' => 'Podría registrar nuevas muertes del grupo en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de muertes de grupo',
            'slug'        => 'deathsgroup.edit',
            'description' => 'Podría editar cualquier dato de una muerte de grupo del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar muerte de grupo',
            'slug'        => 'deathsgroup.destroy',
            'description' => 'Podría eliminar cualquier muerte de grupo del sistema',
        ]);

        //Relocations
        Permission::create([
            'name'        => 'Registro de reubicaciones',
            'slug'        => 'relocations.create',
            'description' => 'Podría registrar nuevas reubicaciones en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de reubicaciones',
            'slug'        => 'relocations.edit',
            'description' => 'Podría editar cualquier dato de una reubicación del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar reubicación',
            'slug'        => 'relocations.destroy',
            'description' => 'Podría eliminar cualquier reubicación del sistema',
        ]);

        //Roles
        Permission::create([
            'name'        => 'Navegar roles',
            'slug'        => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name'        => 'Ver detalle de un rol',
            'slug'        => 'roles.show',
            'description' => 'Ve en detalle cada rol del sistema',
        ]);
        Permission::create([
            'name'        => 'Creación de roles',
            'slug'        => 'roles.create',
            'description' => 'Podría crear nuevos roles en el sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de roles',
            'slug'        => 'roles.edit',
            'description' => 'Podría editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar roles',
            'slug'        => 'roles.destroy',
            'description' => 'Podría eliminar cualquier rol del sistema',
        ]);

        //Users
        Permission::create([
            'name'        => 'Navegar usuarios',
            'slug'        => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name'        => 'Ver detalle de usuario',
            'slug'        => 'users.show',
            'description' => 'Ve en detalle cada usuario del sistema',
        ]);
        Permission::create([
            'name'        => 'Edición de usuarios',
            'slug'        => 'users.edit',
            'description' => 'Podría editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
            'name'        => 'Eliminar usuario',
            'slug'        => 'users.destroy',
            'description' => 'Podría eliminar cualquier usuario del sistema',
        ]);
    }
}
