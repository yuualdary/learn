<template>
    <v-app>
        <v-navigation-drawer app v-model="drawer">
            <!-- -->

            <v-list>
                <v-list-item v-if="!guest">
                    <v-list-item-avatar>
                        <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title class="title">
                            John Leider
                        </v-list-item-title>
                        <v-list-item-subtitle>john@vuetifyjs.com</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-action>
                        <v-icon>mdi-menu-down</v-icon>
                    </v-list-item-action>
                </v-list-item>
                <div class="pa-2" v-if="guest">
                    <v-btn block color="primary" class="mb-1">
                        <v-icon left>mdi-lock</v-icon>
                        login
                    </v-btn>
                    <v-btn block color="success">
                        <v-icon left>mdi-lock</v-icon>
                        Register
                    </v-btn>

                </div>
                <v-divider></v-divider>

                <v-list-item v-for="(item, index) in menus" :key="`menu-`+index" :to="item.route">
                    <v-list-item-icon>
                        <v-icon left>{{item.icon}}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{item.title}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <template v-slot:append v-if="!guest">
                <div class="pa-2">
                    <v-btn block color="red" dark>
                        <v-icon left>mdi-lock</v-icon>
                        logout
                    </v-btn>
                </div>
            </template>
        </v-navigation-drawer>

        <v-app-bar app color="success" dark v-if="isHome">
            <!-- -->
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>My App</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-badge color="orange" overlap>
                    <template v-slot:badge>
                        <span>3</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
            </v-btn>
            <v-text-field slot="extension" 
            hide-details 
            append-icon="mdi-microphone" flat 
            label="Search" 
            prepend-inner-icon ="mdi-magnify"
            solo-inverted></v-text-field>
           
        </v-app-bar>
         <v-app-bar app color="success" dark v-else>
            <!-- -->            
            <v-btn icon @click.stop="$router.go(-1)">
                <v-icon>mdi-arrow-left-circle</v-icon>
            </v-btn>

          
            <v-btn icon>
                <v-badge color="orange" overlap>
                    <template v-slot:badge>
                        <span>3</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
            </v-btn>  
           
        </v-app-bar>

        <!-- Sizes your content based upon appl ication components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

                <!-- If using vue-router -->
            <v-slide-y-transition>
                <router-view></router-view>
            </v-slide-y-transition>
            </v-container>
        </v-main>

            <!-- -->
            <v-card>
                <v-footer absolute app>
                    <v-card-text class="text-center">
                    &copy;{{new Date().getFullYear()}}-<strong>Learn</strong>
                    </v-card-text>
                </v-footer>
            </v-card>
    </v-app>
</template>

<script>
    export default {
        name: 'App',
        data: () => ({
            drawer: false,
            menus: [{
                    title: 'Home',
                    icon: 'mdi-home',
                    route: '/'
                },
                {
                    title: 'Campaigns',
                    icon: 'mdi-hand-heart',
                    route: '/campaigns'
                }
            ],
            guest: false,
        }),
        computed:{
            isHome(){
                return(this.$route.path==='/')
            },
        }


    }

</script>
