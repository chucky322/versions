# **Versioning for SAS**


### **Used technologies:**
1. JS
2. AJAX
3. PHP
4. SAS MACRO
5. HTML, CSS



### **Description of files:**
**change_get_all_events** - получает все возможные ивенты. Используется при изменение сборки модели

**change_code_status** - отправляет 3 переменные RELEASE_VER_ID, REQUEST_TYPE, ACTION_USER. При получениее сервис изменяет код статус сборки модели

**get_release_type** - получает все возможные типы сборок

**copy_get_all_dict_tables** - Отправляет 1 переменную TMP_OPTION. При получение сервис отправляет список всех справочников. Используется при создание новой сборки модели на основе выбранной версии сборки.

**copy_get_all_events** - получает список всех ивентов.

**copy_get_special_dict** - отправляет TMP_OPTION. Сервис отправляет список всех справочников, которые используются в этой сборке.

**copy_new_release_version** - Создает новую сборку модели на основе выбранной модели. Переменные для отправки: RELEASE_VERSION, RELEASE_TYPE1_ID,TEXT_COMMENT,USER,EVENT_NAME,DICT_VER_ID

**create_table_version** - Создает список всех созданных версий сборок

**delete_release_version** - Удаляет выбранную версию сборки(надо исправить на изменение флага)

**get_all_dict_tables** - Отправляет 1 переменную TMP_OPTION. При получение сервис отправляет список всех справочников. Используется при создание новой сборки модели.

**get_all_events** - получает список всех ивентов.

**get_special_dict** - отправляет TMP_OPTION. Сервис отправляет список всех справочников, которые используются в этой сборке.
index - авторизация пользователя

**logout** - выход из сессии пользователя

**new_release_version** - Создает новую сборку модели на основе выбранной модели. Переменные для отправки: RELEASE_VERSION, RELEASE_TYPE1_ID,TEXT_COMMENT,USER,EVENT_NAME,DICT_VER_ID

**get_release_versions_by_release_type1_id** - получает список всех версий сборок выбранным типом сборки

**check_auth** - проверяет логин на сессию.

**update_release_version** - изменяет выбранную версию модели сборки

