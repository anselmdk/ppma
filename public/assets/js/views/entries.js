// Generated by CoffeeScript 1.7.1
(function() {
  define(['backbone', 'handlebars', 'collections/entries', 'views/entry', 'text!/assets/js/templates/entries/index.hbs'], function(Backbone, Handlebars, EntryCollection, EntryView, template) {
    return Backbone.View.extend({
      initialize: function() {
        this.template = Handlebars.compile(template);
        this.render();
        this.entries = new EntryCollection();
        this.listenTo(this.entries, 'add', this.addEntry);
        return this.entries.fetch();
      },
      render: function() {
        this.$el.html(this.template());
        this.table = this.$el.find('table');
        this.placeholder = this.$el.find('.no-entries');
        return this.table.hide();
      },
      addEntry: function(model) {
        var entry;
        entry = new EntryView({
          model: model,
          el: this.table.find('tbody')
        });
        entry.render();
        this.table.show();
        return this.placeholder.hide();
      }
    });
  });

}).call(this);

//# sourceMappingURL=entries.map
