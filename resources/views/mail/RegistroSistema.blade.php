{{-- Plantilla para enviar el correo de bienvenida al sistema --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; padding: 20px;">
        <tr>
            <td
                style=" background: radial-gradient(circle, #06033d, #121676);  border-radius: 8px 8px 0 0; padding: 10px; text-align: center;">
               <img class="logo-custom" style="height: 150px;" src="{{ asset('images/SIP-CUAltos.png') }}" />
            </td>
        </tr>

        <tr>
            <td style="padding: 20px;">
                <h3 style="color: #333333;">Estimad@ <strong>{{ $nombre }}</strong></h3>
                <p>Te damos la bienvenida a SIP-CUAltos. Tu registro al sistema ha sido exitoso.</p>
                <p>A continuación, te proporcionamos los detalles de tu cuenta:</p>

                <ul>
                    <li><strong>Usuario:</strong> {{ $username }}</li>
                    <li><strong>Contraseña por defecto:</strong>  {{ config('app.default_pass') }}</li>
                </ul>
                <p>Para garantizar la seguridad de tu cuenta, te recomendamos que cambies tu contraseña por una nueva
                    tan pronto como sea posible.</p>
        
                <p>Para ingresar al sistema dirigete a: <a href="https://sip-cualtos.udg.mx/"><span style="color:#121676">https://sip-cualtos.udg.mx/</span></a></p>

                <p>Gracias por unirte a nuestro sistema.</p>
                <p>Saludos cordiales,<br>SIP-CUAltos.</p>
            </td>
        </tr>
        <tr>
            <td
                style=" background: radial-gradient(circle, #06033d, #121676);  border-radius: 8px 8px 0 0; padding: 10px; text-align: center; color:white;">
              <p style="font-size: 0.8rem; padding-left:15px; padding-right: 15px;"> Desarrollado por <a style="text-decoration: none; color:white" href="https://cta.cualtos.udg.mx/"><b> CTA CUAltos</b></a>, 
                consulta nuestra  <a style="text-decoration: none; color:white" href="https://udg.mx/politica-de-privacidad-y-manejo-de-datos"> <b>Política de privacidad </b>  y <b> manejo de datos.</b></a></p>
            </td>
        </tr>
    </table>

</body>

</html>
