<template>
    <div class="order-tabs">
        <ul class="nav nav-tabs order-tabs__ul mb-4">
            <li v-for="(tab, i) in tabs" :key="i" class="nav-item">
                <a :href="'#!tab-' + (i + 1)"
                    class="nav-link"
                    v-html="tab.name"
                    :class="{ 'active': tab.active }"
                    @click="selectedTab(tab)"
                >
                </a>
            </li>
        </ul>
        <div class="px-3">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tabs: [],
        };
    },

    created() {
        this.tabs = this.$children;
        this.selectedTab()
    },

    methods: {
        selectedTab(selectedTab = null) {
            setTimeout(() => {
                let hash = window.location.hash.substring(0);

                if (hash) {
                    Event.$emit("tab-changed", hash)
                }

                this.tabs.forEach(tab => {
                    if (!selectedTab && hash) {
                        tab.active = tab.$attrs.hash == hash;
                    } else if (!hash && !selectedTab) {
                        tab.active = tab.$attrs.hash == '#!tab-1';
                    } else {
                        tab.active = tab.name == selectedTab.name;
                    }
                });
            }, 20);
        },
    },
};
</script>