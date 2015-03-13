angular.module('ppmaEntryModule').config([

  '$translateProvider'
  ($translateProvider) ->

    $translateProvider.translations('en'
      DELETE_HEAD: 'Delete Entry'
      DELETE_QUESTION: 'Do you really want to delete this entry?'
      DELETE_YES: 'Yes'
      DELETE_NO: 'No'
      FORM_BUTTON_CANCEL: 'Cancel'
      FORM_BUTTON_CREATE: 'Create'
      FORM_BUTTON_UPDATE: 'Update'
      FORM_ERROR_SUMMARY: 'There was some errors'
      FORM_ERROR_PASSWORD_REQUIRED: 'Password cannot be blank'
      FORM_LABEL_NAME: 'Name'
      FORM_LABEL_CATEGORY: 'Category'
      FORM_LABEL_USERNAME: 'Username'
      FORM_LABEL_PASSWORD: 'Password'
      FORM_LABEL_URL: 'URL'
      FORM_LABEL_TAGS: 'Tags'
      INDEX_HEAD: 'All Entries'
      INDEX_TH_HEAD_NAME: 'Name'
      INDEX_TH_HEAD_TAGS: 'Tags'
      UPDATE_HEAD: 'Delete Entry'
    )

    $translateProvider.translations('de'
      CREATE_HEAD: 'Eintrag erstellen'
      DELETE_HEAD: 'Eintrag löschen'
      DELETE_QUESTION: 'Möchtest du diesen Eintrag wirklich löschen?'
      DELETE_YES: 'Ja'
      DELETE_NO: 'Nein'
      FORM_BUTTON_CANCEL: 'Abbrechen'
      FORM_BUTTON_CREATE: 'Erstellen'
      FORM_BUTTON_UPDATE: 'Aktualisieren'
      FORM_ERROR_SUMMARY: 'Es sind Fehler aufgetreten'
      FORM_ERROR_PASSWORD_REQUIRED: 'Passwort darf nicht leer sein'
      FORM_LABEL_NAME: 'Name'
      FORM_LABEL_CATEGORY: 'Kategorie'
      FORM_LABEL_USERNAME: 'Benutzername'
      FORM_LABEL_PASSWORD: 'Passwort'
      FORM_LABEL_URL: 'URL'
      FORM_LABEL_TAGS: 'Tags'
      INDEX_HEAD: 'Alle Einträge'
      INDEX_TH_HEAD_NAME: 'Name'
      INDEX_TH_HEAD_TAGS: 'Tags'
      UPDATE_HEAD: 'Eintrag löschen'
    )

    return

])