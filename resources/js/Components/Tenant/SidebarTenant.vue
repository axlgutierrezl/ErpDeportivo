<template>
    <v-list nav v-model:opened="openMenu" class="sidebar-menu">
        <template v-for="(item, index) in menu">
            <template v-if="item.newSubMenu.length == 0">
                <v-list-item :key="index" :value="item + (index + 1000 + item.id)" :prepend-icon="item.icon"
                    :title="item.title" v-model="item.active" :active="route().current(item.route)"
                    @click="VisitPage(item.route)">
                </v-list-item>
            </template>
            <template v-else>
                <v-list-group v-model="item.active" :key="Number(item.id)" :value="item.title + '-' + (item.id + 1000)"
                    :title="item.title" @click="OpenSubMenu(item.title + '-' + (item.id + 1000))">
                    <template v-slot:activator="{ props }">
                        <v-list-item v-bind="props" :prepend-icon="item.icon" :title="item.title" class="rounded-lg">
                        </v-list-item>
                    </template>
                    <v-list-item v-for="(sub, num) in item.newSubMenu" :key="num"
                        :value="sub.title + (num + 1000 + index)" :title="sub.title" @click="VisitPage(sub.route)"
                        :active="isActiveSubMenu(sub)"
                        :prepend-icon="isActiveSubMenu(sub) ? 'mdi:mdi-rhombus-medium' : sub.icon" exact>
                    </v-list-item>
                </v-list-group>
            </template>
        </template>
    </v-list>
</template>
<script>
export default {
    name: "SidebarTenant",
    data() {
        return {
            dataMenu: [
                {
                    "id": 1,
                    "title": "Panel de control",
                    "to": "welcome",
                    "icon": "mdi:mdi-table",
                    "slug": "panelcontrol",
                    "subMenu": [],
                    "route": "tenant.dashboard",
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 2,
                    "title": "Alquiler campo",
                    "to": "alquiler-campo",
                    "icon": "mdi:mdi-cash",
                    "slug": "alquiler.campo",
                    "subMenu": [
                        {
                            "id": 1,
                            "title": "Campos",
                            "to": "campos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.campos.index"
                        },
                    ],
                    "route": "tenant.alquilercampo",
                    "active": false,
                    "newSubMenu": [],
                },
                {

                    "id": 3,
                    "title": "Cajas",
                    "to": "cajas",
                    "icon": "mdi:mdi-archive",
                    "slug": "caja",
                    "subMenu": [
                        {
                            "id": 2,
                            "title": "Cajas",
                            "to": "caja",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.caja.index"
                        },
                        {
                            "id": 3,
                            "title": "Apertura y Cierre",
                            "to": "movimientos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.caja.movimientos.index"
                        },
                        {
                            "id": 4,
                            "title": "Egreso",
                            "to": "egresos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.caja.egreso.index"
                        }
                    ],
                    "active": true,
                    "newSubMenu": [],
                },
                {
                    "id": 4,
                    "title": "Compras",
                    "to": "compras",
                    "icon": "mdi:mdi-cart",
                    "slug": "compras",
                    "subMenu": [
                        {
                            "id": 5,
                            "title": "Proveedores",
                            "to": "proveedores",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.compras.proveedores"
                        },
                        {
                            "id": 6,
                            "title": "Orden compras",
                            "to": "ordenes",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.compras.ordenes"
                        },
                        {
                            "id": 7,
                            "title": "Documento de compra",
                            "to": "documentos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.compras.documentos"
                        }
                    ],
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 5,
                    "title": "Ventas",
                    "to": "ventas",
                    "icon": "mdi:mdi-blur-linear",
                    "slug": "ventas",
                    "subMenu": [
                        {
                            "id": 8,
                            "title": "Clientes",
                            "to": "clientes",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.ventas.clientes.index"
                        },
                        {
                            "id": 9,
                            "title": "Cotizaciones",
                            "to": "cotizacion",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.ventas.cotizaciones.index"
                        },
                        {
                            "id": 10,
                            "title": "Doc. venta",
                            "to": "documentos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.ventas.documentos.index"
                        },
                        {
                            "id": 11,
                            "title": "Guia de remisión",
                            "to": "guia-remision",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.ventas.guiaremision.index"
                        }
                    ],
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 6,
                    "title": "Almacén",
                    "to": "almacen",
                    "icon": "mdi:mdi-store",
                    "slug": "almacen",
                    "subMenu": [
                        {
                            "id": 12,
                            "title": "Almacenes",
                            "to": "almacenes",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.almacenes.index"
                        },
                        {
                            "id": 13,
                            "title": "Categorias",
                            "to": "categorias",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.categorias.index"
                        },
                        {
                            "id": 14,
                            "title": "Marcas",
                            "to": "marcas",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.marcas.index"
                        },
                        {
                            "id": 15,
                            "title": "Productos",
                            "to": "productos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.productos.index"
                        },
                        {
                            "id": 16,
                            "title": "Servicios",
                            "to": "servicios",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.servicios.index"
                        },
                        {
                            "id": 17,
                            "title": "Nota de ingreso",
                            "to": "nota-ingreso",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.notaingreso.index"
                        },
                        {
                            "id": 18,
                            "title": "Nota de salida",
                            "to": "nota-salida",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.almacen.notasalida.index"
                        }
                    ],
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 7,
                    "title": "Configuración",
                    "to": "configuracion",
                    "icon": "mdi:mdi-cash-multiple",
                    "slug": "configuracion",
                    "subMenu": [
                        {
                            "id": 19,
                            "title": "Campos",
                            "to": "campos",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.configuracion.campos.index"
                        },
                        {
                            "id": 20,
                            "title": "Horarios de trabajo",
                            "to": "horarios",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.configuracion.horariotrabajos.index"
                        },
                        {
                            "id": 21,
                            "title": "Empresa",
                            "to": "empresa",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.configuracion.empresa.index"
                        }
                    ],
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 8,
                    "title": "Seguridad",
                    "to": "seguridad",
                    "icon": "mdi:mdi-key",
                    "slug": "seguridad",
                    "subMenu": [
                        {
                            "id": 22,
                            "title": "Usuarios",
                            "to": "usuarios",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.seguridad.usuarios.index"
                        },
                        {
                            "id": 23,
                            "title": "Roles",
                            "to": "roles",
                            "icon": "mdi:mdi-rhombus-medium-outline",
                            "route": "tenant.seguridad.roles.index"
                        }
                    ],
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 9,
                    "title": "Tienda",
                    "to": "tienda",
                    "icon": "mdi:mdi-table",
                    "subMenu": [],
                    "route": "tenant.tienda",
                    "active": false,
                    "newSubMenu": [],
                },
            ],
            menu: [],
            modules: [],
            openMenu: []
        }
    },
    created() {
        const path = location.pathname.split("/");
        this.modules = this.$page.props.modules[0].modules;
        this.loadingModules();
        if (path.length > 2) {
            const currentPath = path[1];
            const current = this.menu.find(x => x.to == currentPath);
            if (current) {
                let num = 1000;
                this.openMenu.push(current.title + "-" + (num + current.id));
            }
        }
    },
    methods: {
        VisitPage(route) {
            try {
                let current = this.route(route);
                if (current != location.href) {
                    this.$inertia.visit(this.route(route))
                }
            } catch (ex) {
                console.log(ex);
            }
        },
        OpenSubMenu(path) {
            
            const existe = this.openMenu.find(x => x == path);
            if (!existe) {
                this.openMenu = [];
            } else {
                this.openMenu = [path];
            }
        },
        isActiveSubMenu(item) {
            const currentPath = route().current(item.route);

            if (currentPath) {
                return true;
            } else {
                const path = location.pathname.split("/");

                const current = this.menu.find(x => x.to == path[1]);

                if (current) {
                    const sub = current.newSubMenu.find(n => n.to == path[2]);

                    if (sub) {
                        if (item.to == sub.to) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        },
        loadingModules() {
            this.dataMenu.forEach(item => {
                let existe = this.modules.find(x => x.id == item.id);
                if (existe) {
                    this.menu.push(item);
                }
            });
            this.menu.forEach(item => {
                item.subMenu.forEach(sub => {
                    let module = this.modules.find(x => x.id === item.id);
                    if (module) {
                        let level = module.levels.find(l => l.id == sub.id);
                        if (level) {
                            item.newSubMenu.push(sub);
                        }
                    }
                });
            });
        }
    },
    mounted() {
        
    }
}
</script>
<style>
.sidebar-menu .v-list-item .v-list-item-title {
    font-size: 15px;
}

.sidebar-menu .fas:before {
    display: inline-block;
    font-size: 0.7em;
    text-rendering: auto;
    line-height: inherit;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.v-icon.mdi-rhombus-medium-outline::before {
    font-size: .6em !important;
}

.v-icon.mdi-rhombus-medium::before {
    font-size: .6em !important;
}

.v-icon.mdi-rhombus-medium-outline {
    margin-right: 8px !important;
}

.v-icon.mdi-rhombus-medium {
    margin-right: 8px !important;
}
</style>