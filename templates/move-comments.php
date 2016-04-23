<form id="move-comments-form" method="post">
    <h1>Mueve todos los comentarios de un Usuario a otro</h1>
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row"><label for="user-origin">Selecciona el Usuario al que le va ha quitar los
                    comentarios:</label></th>
            <td><?php wp_dropdown_users(array('name' => 'user-origin')); ?></td>
        </tr>
        <tr>
            <th scope="row"><label for="user-destination">Selecciona el Usuario al que le va ha Adjudicar los
                    comentarios anteriores:</label></th>
            <td><?php wp_dropdown_users(array('name' => 'user-destination')); ?></td>
        </tr>
        </tbody>
    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar">
    </p>
</form>