<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-sm>
            <v-subheader>
                All Campaigns
            </v-subheader>
            <v-layout wrap>
                <v-flex v-for="(campaign) in campaigns" :key="`category-`+campaign.id" xs6>
                     <v-card :to="'/category'+campaign.id">
                          <v-img :src="campaign.campaign_photo" class="black--text">

                            <v-card-title class="fill-height align-end" v-text="campaign.title"></v-card-title>
                            </v-img>
                        </v-card>
                    </v-flex>
                </v-layout>
                <v-pagination v-model="page" @input="go" :length="lengthPage" :total-visible="6">
                </v-pagination>
            </v-container>

        </div>
    </template>

    <script>
        export default {
            data:()=>({
                campaigns:[],
                page:0,
                lengthPage:0
            }),
            created(){
                this.go()
            },

            methods:{

                

                go(){
                    let url = 'api/campaign/all?page='+this.page
                    axios.get(url)
                        .then((response)=>{
                            let{data}= response.data
                            this.campaigns=data.campaigns.data
                            this.page=data.campaigns.current_page
                            this.lengthPage=data.campaigns.last_page
                        })
                        .catch((error)=>{
                            let{response}=error
                            console.log(response)
                        })
                   }
            },
           

        }

    </script>
