document.addEventListener('DOMContentLoaded',function() {

	uri.parse();

	if(document.querySelector('select[name="sort"]')){
    	document.querySelector('select[name="sort"]').onchange=sortThreads;
	}

	tinymce.init({ 
		selector:'.richtext',
		menubar:false,
		plugins: [
	    'link image preview anchor'
	  ],
		toolbar: 'undo redo | styleselect | bold italic | link image',
	});

},false);

function sortThreads(e){
	var v = e.target.value;
	var path = uri.path=='/' || uri.path=='' ? 'threads' : uri.path;
	
	window.location = path + '?' + uri.request({'sort' : v});
}


var uri = {
	path: null,

	params: null,

	requests: [],

	parse: function(){
		this.path = window.location.pathname;

		this.params = window.location.search.substring(1);

		this.setRequest();
	},

	all: function(){

	},

	setRequest: function(){
		if(this.params==null) return false;

		var parts = this.params.split('&');

		for (var i = 0; i < parts.length; i++) {
		    var val = parts[i].split("=");
		    if(val[1]!=undefined){
		    	this.requests[unescape(val[0])] = unescape(val[1]);

		    	// Object.defineProperty(this, unescape(val[0]), {
		    	// 	value: unescape(val[1])
		    	// });	    
		    }
		}
	},

	request: function(append_params){

		for(var ap in append_params)
			this.requests[ap] = append_params[ap];

		var args = [];

		for(var req in this.requests){
	
			args.push(req + '=' + this.requests[req]);
			
		}

		return args.join('&');

	}


}