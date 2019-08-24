<template>
    <div @mouseover="stopTimer()" @mouseleave="startTimer()">
        <transition name="appear" mode="out-in" appear>
            <div class="page-messages"
                role="alert"
                v-if="visible"
            >
                <div :class="currentClass()" class="alert animated flipInX alert-dismissible">
                    <h4 v-if="state == 'error'">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ header }}
                    </h4>
                    <h4 v-else-if="state == 'success'">
                        <i class="fas fa-check mr-2"></i> {{ header }}
                    </h4>
                    <p><slot></slot></p>

                    <span class="close" data-dismiss="alert" @click="visible = false">
                        <span v-if="timerStopped"><i class="fas fa-pause"></i></span>
                        <span v-else v-text="counter"></span> 
                        <i class="fas fa-times-circle"></i>
                    </span>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visible: true,
            counter: 3,
            timerStopped: false,
            intervalId: 0,
            successMessage: 'alert-success',
            errorMessage: 'alert-danger'
        }
    },

    props: ['state', 'header'],

    created() {
        this.startTimer()
    },

    methods: {
        currentClass() {
            return this.state == 'success'
                ? this.successMessage
                : this.errorMessage
        },

        stopTimer() {
            clearInterval(this.intervalId)
            this.timerStopped = true
        },

        startTimer() {
            this.timerStopped = false
            this.intervalId = setInterval(() => {
                if (this.counter <= 0) {
                    this.visible = false;
                } else {
                    this.counter--
                }
            }, 1000);
        }
    },
}
</script>

<style lang="scss" scoped>
.appear {
    &-enter-active,
    &-leave-active {
        transition: transform 200ms;
    }
    &-enter,
    &-leave-to {
        transform: rotateX(90deg);
    }
    &-enter-to,
    &-leave {
        transform: rotateX(0);
    }
}
</style>