var Http = {
    loading() {
        $('<div class="loading"></div>').appendTo('body');
    },
    done() {
        $('div.loading').remove();
    },
    get(params) {
        let data = {
            type: 'GET',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        };
        data = Object.assign(data, params);
        return this.send(data);
    },
    post(params) {
        let data = {
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        };
        data = Object.assign(data, params);
        return this.send(data);
    },
    delete(params) {
        let data = {
            type: 'DELETE',
        };
        data = Object.assign(data, params);
        return this.send(data);
    },
    put(params) {
        let data = {
            type: 'PUT',
        };
        data = Object.assign(data, params);
        return this.send(data);
    },
    send(opt) {
        let data = {
            async: true,
            url: '',
            type: 'GET',
            data: {},
            dataType: 'json',
        };
        data = Object.assign(data, opt);
        return $.ajax(data);
    }
};
export default Http;
