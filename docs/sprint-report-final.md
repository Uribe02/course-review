# Informe Final de Sprint — Simulación Desarrollo Web SSR

**Proyecto:** course-review

**Autor(es):** Equipo de simulación

**Fecha:** 2025-11-26

---

## Resumen ejecutivo
Este documento resume la simulación de un sprint para implementar la funcionalidad de gestión de cursos (SSR) en la aplicación `course-review`. El objetivo principal fue entregar un CRUD de cursos para el dashboard autenticado y vistas públicas para consultar cursos por `slug`.

## Objetivos del sprint
- Implementar CRUD completo para `Course` (crear, leer, actualizar, eliminar).
- Añadir validaciones y protección de rutas (autenticación para rutas administrativas).
- Exponer detalle público por `slug` y permitir reseñas públicas.
- Documentar el sprint y entregar evidencias (migraciones, capturas, comandos ejecutados).

## Alcance y criterios de aceptación
- El usuario autenticado puede crear, editar y eliminar cursos desde `/dashboard/courses`.
- Los cursos públicos son accesibles mediante `GET /curso/{slug}`.
- Validaciones: `title` (required, max 255), `description` (required), `instructor` (required, max 100).
- La base de datos contiene la tabla `courses` con columnas: `id`, `title`, `slug`, `description`, `instructor`, `created_at`, `updated_at`.

## Equipo y roles (simulado)
- Product Owner: [Nombre PO]
- Scrum Master: [Nombre SM]
- Desarrollador(es): [Nombre(s)]
- QA/Tester: [Nombre QA]

## Product Backlog (historias / tareas)
- Historia A: Como admin, quiero crear un curso (estimación: 3h).
- Historia B: Como admin, quiero editar un curso (estimación: 2h).
- Historia C: Como admin, quiero eliminar un curso (estimación: 1h).
- Historia D: Como usuario público, quiero ver detalle por slug (estimación: 2h).
- Historia E: Como usuario, quiero añadir reseñas a cursos (estimación: 4h).

## Sprint Backlog (tareas realizadas)
- Crear migración `create_courses_table` y `create_reviews_table`.
- Implementar modelo `Course` con `fillable` y relación `reviews`.
- Implementar `CourseController` con métodos `index/create/store/edit/update/destroy`.
- Añadir `StoreCourseRequest` y `UpdateCourseRequest` para validación.
- Crear vistas Blade para dashboard (`courses.index`, `courses.create`, `courses.edit`, `courses.show` públicas) con componentes de botones.
- Ajustes de CSS/Tailwind y compilación de assets.
- Verificación y corrección de esquema en DB (añadir columnas faltantes si era necesario).
- Documentación del sprint (este documento) y evidencia en `docs/`.

## Plan de trabajo / Cronograma (resumen)
- Día 1: Preparar proyecto, migraciones y modelo.
- Día 2: Implementar controlador y vistas para CRUD.
- Día 3: Validaciones, relaciones y pruebas manuales.
- Día 4: Ajustes UI, compilación assets y documentación.

## Entregables
- Código fuente en el repositorio `course-review` (branch `main`).
- Migraciones aplicadas (tabla `migrations` registra las migraciones).
- Informe de sprint `docs/sprint-report-final.md` y `docs/sprint-report-final.html`.

## Evidencia técnica (comandos y salida relevante)
- Base de datos usada (archivo `.env`): `DB_DATABASE=course_review_db`.
- Comprobación de columnas (script `tools/check_db.php`) indicó inicialmente que faltaban columnas; luego se añadieron.
- Comandos ejecutados para reparación y verificación:

```powershell
php artisan config:clear
php artisan cache:clear
php artisan migrate
php artisan tinker
# scripts temporales ejecutados en tools/
php tools\check_db.php
php tools\check_migrations.php
php tools\add_course_columns.php
php tools\create_test_course.php
npm run build
```

- Resultado relevante: tabla `courses` ahora contiene `title`, `slug`, `description`, `instructor`.
- Se creó un curso de prueba vía Eloquent (ID 1) para verificar la inserción.

## UI / Estilos y mejora de botones
- Se actualizaron los componentes de botón para mejorar visibilidad y contraste:
  - `resources/views/components/primary-button.blade.php` (más padding, `bg-indigo-600`, `shadow-md`, `text-sm`)
  - `resources/views/components/secondary-button.blade.php` (borde índigo y texto índigo)
  - `resources/views/components/danger-button.blade.php` (botón rojo más grande con sombra)
- Se actualizó `resources/views/courses/index.blade.php` para usar las clases y componentes actualizados (botón "Crear Nuevo Curso", botones Editar y Eliminar).
- Se compiló CSS con `npm run build` para aplicar cambios Tailwind.

## Posibles problemas encontrados y soluciones
- Problema: Error SQL "Unknown column 'title' in 'field list'" al crear cursos.
  - Causa: La tabla `courses` en la BD activa no tenía las columnas definidas por la migración (probablemente migración aplicada en otra DB o creada manualmente sin columnas).
  - Solución aplicada: Script `tools/add_course_columns.php` añadió las columnas faltantes con ALTER TABLE de forma segura.

## Retrospectiva / Lecciones aprendidas
- Asegurar siempre la coherencia entre `.env` y la BD que se inspecciona (evitar mirar otra base por error).
- Mantener la salida de migraciones y revisar `migrations` para confirmar ejecución.
- Añadir tests que comprueben esquema mínimo de tablas para evitar fallos en producción.

## Anexos / Archivos relevantes
- Migraciones: `database/migrations/2025_11_26_005436_create_courses_table.php`, `2025_11_26_005447_create_reviews_table.php`.
- Scripts temporales (para verificación): `tools/check_db.php`, `tools/check_migrations.php`, `tools/add_course_columns.php`, `tools/create_test_course.php`.
- Informe (esta versión): `docs/sprint-report-final.md` y `docs/sprint-report-final.html`.
- Capturas de pantalla: añadir en `docs/evidence/` si deseas que las incluya en el PDF final.

---

### Cómo generar PDF localmente
- Opción rápida: abrir `docs/sprint-report-final.html` en el navegador y usar "Imprimir" → "Guardar como PDF".
- Opción con herramientas CLI (si tienes `pandoc`):

```powershell
pandoc docs/sprint-report-final.md -o docs/sprint-report-final.pdf --from markdown --pdf-engine=wkhtmltopdf
```

- Opción con Node (si deseas que lo haga aquí, puedo intentar ejecutar `npx markdown-pdf` si autorizas la instalación automática):

```powershell
npx markdown-pdf docs/sprint-report-final.md -o docs/sprint-report-final.pdf
```

---

> Nota: Si quieres que genere el PDF por ti ahora, autorizame a ejecutar el comando `npx markdown-pdf` (descarga e install temporal). Alternativamente, sube las capturas en `docs/evidence/` y las incrusto en la versión final y luego genero el PDF.
