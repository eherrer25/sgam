<template>

</template>

    <script>
    export default {
        data() {
            return {allJobs: this.jobs}
        },
        created() {
            let vm = this
            vm.refreshAllJobs = (e) => axios.get('/jobs').then((e) => (vm.allJobs = e.data))
            Echo.channel('email-queue')
                .listen('.add', (e)  => vm.refreshAllJobs(e))
                .listen('.sent', (e) => vm.refreshAllJobs(e))
        }
    }
    </script>
