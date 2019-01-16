<template>
    <a href="#!" v-on:click="deleteItem()" :title="deleting" class="grey">
        <i class="fas fa-trash-alt"></i>
    </a>
</template>

<script>
export default {
    props: ['deleting', 'slug', 'redirect'],
    methods: {
        deleteItem() {
            if (confirm('Удалить этот товар?')) {
                this.$axios.delete('/api/item/' + this.slug)
                    .then(res => {
                        Event.$emit("item-deleted")
                        if (this.redirect) {
                            window.location.href = this.redirect
                        }
                    })
                    .catch(error => console.error(error))
            }
        },
    },
}
</script>