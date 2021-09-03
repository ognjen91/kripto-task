<template>
<div class="full-size-dark-wrap fixed flex justify-center items-center" :class="wrapperClasses">
        <div class="floating-window bg-white flex flex-col relative" :class="windowClasses">
                
                <!-- CLOSE BTN -->
                <div class='absolute top-0 right-3 close cursor-pointer' @click='close'>
                    <IconTimes />
                </div>

                <div class="w-full title-holder">
                   <p class='w-full text-center font-medium'><slot name="title"></slot></p>
                </div>

                 <hr class='absoulte w-full left-0'>

                 <slot name="header"></slot>
                 <slot name="subheader"></slot>


                <!-- SLOT FOR MAIN CONTENT -->
                <div class="floating-window-content flex flex-col">
                        <slot></slot>
                </div>
        </div>
</div>
</template>
<script>
import IconTimes from '@/components/includes/icons/IconTimes'

export default {
        components : {
          IconTimes
        },
        props : {
                wrapperClasses : {
                        Type : String,
                        required : false,
                        default : ""
                },
                windowClasses : {
                        Type : String,
                        required : false,
                        default : ""
                },
                closeLink : {
                        Type : String,
                        required : false,
                        default : "/"
                },
                emitCloseEventOnCloseIconClick : {
                        Type : Boolean,
                        required : false,
                        default : false
                }
        },

        methods : {
                close(){
                     if(!this.emitCloseEventOnCloseIconClick){
                             this.$router.push(this.closeLink)
                             return
                     }   

                     this.$emit('close')
                }
        }
}
</script>