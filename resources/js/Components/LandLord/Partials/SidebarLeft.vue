<template>
    <v-list nav v-model:opened="openMenu" class="sidebar-menu">
        <template v-for="(item, index) in dataMenu">
            <template v-if="item.subMenu.length == 0">
                <v-list-item :key="Number(item.id)" :prepend-icon="item.icon" :title="item.title"
                    @click="VisitPage(item.route)" v-model="item.active" :active="isActive(item)"
                    :value="item + (index + 1000 + item.id)" class="rounded-lg">
                </v-list-item>
            </template>
            <template v-else>
                <v-list-group v-model="item.active" :key="Number(item.id)" :value="item.title + '-' + (item.id + 1000)"
                    :title="item.title" @click="OpenSubMenu(item.title + '-' + (item.id + 1000))">
                    <template v-slot:activator="{ props }">
                        <v-list-item v-bind="props" :prepend-icon="item.icon" :title="item.title" class="rounded-lg">
                        </v-list-item>
                    </template>
                    <v-list-item v-for="(sub, num) in item.subMenu" :key="num"
                        :value="sub.title + (num + 1000 + index)" :title="sub.title" class="mr-3 rounded-pill"
                        @click="VisitPage(sub.route)" :active="isActiveSubMenu(sub)"
                        :prepend-icon="isActiveSubMenu(sub) ? 'mdi:mdi-checkbox-blank-circle' : sub.icon" exact>
                    </v-list-item>
                </v-list-group>
            </template>
        </template>
    </v-list>

</template>
<script>
export default {
    data() {
        return {
            dataMenu: [
                {
                    "id": 1,
                    "title": "Panel de control",
                    "to": "dashboard",
                    "icon": "mdi:mdi-table",
                    "subMenu": [],
                    "route": "landlord.welcome",
                    "active": false,
                    "newSubMenu": [],
                },
                {
                    "id": 2,
                    "title": "Clientes",
                    "to": "cliente",
                    "icon": "mdi:mdi-cash",
                    "subMenu": [],
                    "route": "landlord.cliente.index",
                    "active": false,
                    "newSubMenu": [],
                }
            ],
            menu: [],
            openMenu: [],
            permisos: [],
        }
    },

    created() {
        const path = location.pathname.split("/");
        // this.permisos = this.$page.props.can.permisos;
        // this.LoadingMenuPermisos();
        if (path.length > 2) {
            const currentPath = path[1];
            const current = this.dataMenu.find(x => x.to == currentPath);
            if (current) {
                let num = 1000;
                this.openMenu.push(current.title + "-" + (num + current.id));
            }
        }

    },

    methods: {
        isActive(item){
            const currentPath = route().current(item.route);
            if(currentPath){
                return true;
            }else{
                const path = location.pathname.split("/");
                if(item.to == path[1]){
                    return true;
                }else{
                    return false;
                }
            }
        },
        OpenSubMenu(path) {
            console.log("sss", path);
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
                const current = this.dataMenu.find(x => x.to == path[1]);

                if (current) {
                    const sub = current.subMenu.find(n => n.to == path[2]);

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
        LoadingMenuPermisos() {

            this.dataMenu.forEach(item => {

                if (item.subMenu.length == 0) {
                    let permiso = this.permisos.find(x => x == item.route);
                    if (permiso) {
                        this.menu.push(item);
                    }
                } else {
                    let submenu = this.permisos.find(x => x.indexOf(item.slug) != -1);

                    if (submenu) {
                        this.menu.push(item);
                    }
                }

            });

            this.menu.forEach(item => {
                item.subMenu.forEach((sub, index) => {

                    let existe = this.permisos.find(x => x === sub.route);
                    if (existe) {
                        item.newSubMenu.push(sub);
                    }
                });
            });

        }
    },
}
</script>
<style>

.v-navigation-drawer__content::-webkit-scrollbar:vertical {
    width: 2px !important;
}

.v-navigation-drawer__content::-webkit-scrollbar-button:increment,
.v-navigation-drawer__content::-webkit-scrollbar-button {
    display: none !important;
}

.v-navigation-drawer__content::-webkit-scrollbar:horizontal {
    height: 10px !important;
}

.v-navigation-drawer__content::-webkit-scrollbar-thumb {
    background-color: #363A55 !important;
    border-radius: 20px !important;
}

.v-navigation-drawer__content::-webkit-scrollbar-track {
    border-radius: 10px !important;
}

.v-icon.mdi-checkbox-blank-circle-outline::before {
    font-size: .6em !important;
}

.v-icon.mdi-checkbox-blank-circle::before {
    font-size: .6em !important;
}

.v-icon.mdi-checkbox-blank-circle-outline {
    margin-right: 8px !important;
}

.v-icon.mdi-checkbox-blank-circle {
    margin-right: 8px !important;
}

.sidebar-menu .v-list--one-line .v-list-item--active {
    border-left: 3px solid rgb(var(--v-theme-primary));
    background: transparent;
    opacity: 1;
}

.sidebar-menu .v-list-item .v-list-item-title {
    font-size: 14px;
}

.sidebar-menu .fas:before {
    display: inline-block;
    font: 24px/1 Fontawesome;
    font-size: 0.7em;
    text-rendering: auto;
    line-height: inherit;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>