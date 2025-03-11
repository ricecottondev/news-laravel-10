<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
    <tbody>

        <tr>
            <td align="center" style="padding-bottom: 40px;">
                <a href="#" target="_blank" style="text-decoration: none;">
                    <img src="https://point.indraco.com/images/logo-baru-gray.png" width="152" height="auto"
                        style="vertical-align: sub;">
                </a>
            </td>
        </tr>

        <tr>
            <td align="center">
                <p
                    style="color: inherit; font-family: sans-serif; font-size: 2em; margin-top: 0; margin-bottom: 10px; text-align: center;">
                    <strong>Verifikasi Email</strong>
                </p>
                <p
                    style="color: inherit; font-family: sans-serif; font-size: 1em; margin-top: 0; margin-bottom: 60px; text-align: center;">
                    Harap verifikasi email Anda dengan mengklik tautan di bawah ini:
                </p>
            </td>
        </tr>

        <tr>
            <td align="center">
                <a style="display: inline; text-decoration: none; text-align: center; font-size: 1.5em; background-color: #FF9209; color: #ffffff; padding: .5em 1.5em; border-radius: .25em;"
                    href="{{ route('user.verify', $token) }}">
                    Verifikasi Email
                </a>
            </td>
        </tr>

    </tbody>
</table>
