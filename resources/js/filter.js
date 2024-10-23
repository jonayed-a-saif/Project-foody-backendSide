import moment from 'moment';
import Vue from 'vue';

Vue.filter('timeformat', (arg) => {
    return moment(arg).format('Do MMMM, YYYY, h:mm:ss a')
})

Vue.filter('timeformat2', (arg) => {
    return moment(arg).format('Do MMMM, YYYY')
})

Vue.filter('shortLength', function(text, length, suffix) {
    return text.substring(0, length) + suffix;
})