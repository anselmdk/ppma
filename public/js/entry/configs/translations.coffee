angular.module('ppmaEntryModule').config([

  '$translateProvider'
  ($translateProvider) ->

    $translateProvider.translations('en'
      DELETE_HEAD: 'Delete Entry'
      DELETE_QUESTION: 'Do you really want to delete this entry?'
      DELETE_YES: 'Yes'
      DELETE_NO: 'No'
      INDEX_HEAD: 'All Entries'
      INDEX_TH_HEAD_NAME: 'Name'
      INDEX_TH_HEAD_TAGS: 'Tags'
    )

    $translateProvider.translations('de'
      DELETE_HEAD: 'Eintrag löschen'
      DELETE_QUESTION: 'Möchtest du diesen Eintrag wirklich löschen?'
      DELETE_YES: 'Ja'
      DELETE_NO: 'Nein'
      INDEX_HEAD: 'Alle Einträge'
      INDEX_TH_HEAD_NAME: 'Name'
      INDEX_TH_HEAD_TAGS: 'Tags'
    )

    return

])