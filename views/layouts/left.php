<?php
use yii\helpers\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left ">
                <?= Html::img('@web/img/logo.png', ['alt'=>'some', 'class'=>'img img-responsive']);?> 
            </div>
<!--            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>-->
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
//                    ['label' => 'Menu', 'options' => ['class' => 'text-info']],
//                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->can('ConfigurarParametros')],
                    ['label' => 'Misión, Visión y Valores', 'icon' => 'fa fa-bookmark fa-1x', 'url' => ['/site/info-general']],
                    ['label' => 'Parámetros', 'icon' => 'fa fa-gears fa-1x', 'url' => ['/configuracion'], 'visible' => Yii::$app->user->can('ConfigurarParametros')],
                    ['label' => 'Reporte de horas sociales', 'icon' => 'fa fa-file fa-1x', 'url' => ['/estudiante/generar-reporte'], 'visible' => Yii::$app->user->can('GenerarReporte')],
                    ['label' => 'Proyectos abiertos', 'icon' => 'fa fa-flag fa-1x', 'url' => ['/proyecto/consulta'], 'visible' => Yii::$app->user->can('ConsultaProyectosAbiertos')],
                    ['label' => 'Proyectos asesorados', 'icon' => 'fa fa-users fa-1x', 'url' => ['/proyecto/consulta-asesor'], 'visible' => Yii::$app->user->can('ConsultaAsesor')],
                    ['label' => 'Mis proyectos', 'icon' => 'fa fa-user fa-1x', 'url' => ['/proyecto/consulta-estudiante'], 'visible' => Yii::$app->user->can('ConsultaEstudiante')],
                    ['label' => 'Descarga de formularios', 'icon' => 'fa fa-file fa-1x', 'url' => ['/formularios/descarga'], 'visible' => Yii::$app->user->can('ConsultaEstudiante')],
                    [
                        'label' => 'Usuarios y permisos',
                        'icon' => 'fa fa-user fa-1x',
                        'url' => '#',
                        'visible'=> Yii::$app->user->can('AdministrarRBAC'),
                        'items' => [
                            ['label' => 'Usuarios', 'icon' => '', 'url' => ['/user/manager'], 'visible'=>\Yii::$app->user->can('MantoUsuarios')],
                            ['label' => 'Roles', 'icon' => '', 'url' => ['/rbac/role'], 'visible'=>\Yii::$app->user->can('MantoRoles')],
                            ['label' => 'Permisos', 'icon' => '', 'url' => ['/rbac/permission'], 'visible'=>\Yii::$app->user->can('MantoPermisos')],
                            ['label' => 'Asignacion', 'icon' => '', 'url' => ['/rbac/assignment'], 'visible'=>\Yii::$app->user->can('MantoAsignaciones')],
//                            ['label' => 'Reglas', 'icon' => '', 'url' => ['/rbac/rule'], 'visible'=>\Yii::$app->user->can('MantoReglas')],
                        ],
                    ],        
                    [
                        'label' => 'Catálogos',
                        'icon' => 'fa fa-navicon fa-1x',
                        'url' => '#',
                        'visible'=> Yii::$app->user->can('AdministrarCatalogos'),
                        'items' => [
                            ['label' => 'Universidades', 'icon' => '', 'url' => ['/catalogs/universidad'], 'visible'=>\Yii::$app->user->can('MantoUniversidades')],
                            ['label' => 'Carreras', 'icon' => '', 'url' => ['/catalogs/carrera'], 'visible'=>\Yii::$app->user->can('MantoCarreras')],
                            ['label' => 'Facultades', 'icon' => '', 'url' => ['/catalogs/facultad'], 'visible'=>\Yii::$app->user->can('MantoFacultades')],
                            ['label' => 'Instituciones', 'icon' => '', 'url' => ['/catalogs/institucion'], 'visible'=>\Yii::$app->user->can('MantoInstituciones')],
                            ['label' => 'Proyecto', 'icon' => '', 'url' => ['/catalogs/proyecto'], 'visible'=>\Yii::$app->user->can('MantoProyectos')],
                            ['label' => 'Estudiantes', 'icon' => '', 'url' => ['/catalogs/estudiante'], 'visible'=>\Yii::$app->user->can('MantoPersonas')],
                            ['label' => 'Empleados', 'icon' => '', 'url' => ['/catalogs/empleado'], 'visible'=>\Yii::$app->user->can('MantoPersonas')],
                            ['label' => 'Formularios', 'icon' => '', 'url' => ['/formularios'], 'visible'=>\Yii::$app->user->can('MantoFormularios')],                            
                        ],
                    ],                      
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'visible'=> Yii::$app->user->can('AccederGII'),
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],                          
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
