import numeral from 'numeral'

Vue.component('subscribe-button', {
    props: {
        channel: {
            type: Object,
            required: true,
            default: () => {
            }
        },
        initialSubscriptions: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    computed: {
        subscribed() {
            if (!__auth() || this.channel.user_id === __auth().id) return false
            return !!this.subscription
        },
        owner() {
            if (__auth() && this.channel.user_id === __auth().id) return true
            return false
        },
        count() {
            return numeral(this.subscriptions.length).format('0a')
        },
        subscription() {
            if (! __auth()) return null;
            return this.subscriptions.find(subscription => subscription.user_id === __auth().id)
        }
    },
    data: function () {
        return {
            subscriptions: this.initialSubscriptions
        }
    },
    methods: {
        toggleSubscription() {
            if (!__auth()) {
                return alert('please login first')
            }
            if (this.owner) {
                return alert('you cant subscribe to your channel')
            }
            if (this.subscribed) {
                axios.delete(`/channels/${this.channel.id}/subscriptions/${this.subscription.id}`)
                    .then(response => {
                        this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                    })
                    .catch(error => {

                    })
            } else {
                axios.post(`/channels/${this.channel.id}/subscriptions`)
                    .then(response => {
                        console.log(response.data)
                        this.subscriptions=[...this.subscriptions,response.data]
                    })
            }
        }
    },
});
