<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')
</head>

<body>
    <table border="3">
        <thead>
            <th>developer</th>
            <th>admin</th>
            <th>petugas</th>
        </thead>
        <tbody>
            {{-- developer --}}
            <td>
                <h2>
                    <a href="{{ route('user.index') }}">
                        dev user
                    </a>
                    <br>
                    <a href="{{ route('user.trash') }}">
                        trash user
                    </a>
                </h2>
                <h2>
                    <a href="{{ route('disaster.index') }}">
                        dev disaster
                    </a>
                    <br>
                    <a href="{{ route('disaster.trash') }}">
                        trash disaster
                    </a>
                </h2>
                <h2>
                    <a href="{{ route('post.index') }}">
                        dev post
                    </a>
                    <br>
                    <a href="{{ route('post.trash') }}">
                        trash post
                    </a>
                </h2>
                <h2>
                    <a href="{{ route('req.index') }}">
                        dev req
                    </a>
                    <br>
                    <a href="{{ route('req.trash') }}">
                        trash req
                    </a>
                </h2>
                <h2>
                    <a href="{{ route('aid.index') }}">
                        dev aid
                    </a>
                    <br>
                    <a href="{{ route('aid.trash') }}">
                        trash aid
                    </a>
                </h2>
                <h2>
                    <a href="{{ route('category.index') }}">
                        dev category
                    </a>
                    <br>
                    <a href="{{ route('category.trash') }}">
                        trash category
                    </a>
                </h2>
            </td>

            {{-- admin --}}
            <td> 
                <h2>
                    {{-- <a href="{{ route('devuser.index') }}"> --}}
                    admin user
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devdisaster.index') }}"> --}}
                    admin disaster
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devpost.index') }}"> --}}
                    admin post
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devreq.index') }}"> --}}
                    admin req
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devaid.index') }}"> --}}
                    admin aid
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devcategory.index') }}"> --}}
                    admin category
                    </a>
                </h2>
            </td>

            {{-- petugas --}}
            <td> 
                <h2>
                    {{-- <a href="{{ route('devuser.index') }}"> --}}
                    staff user
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devdisaster.index') }}"> --}}
                    staff disaster
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devpost.index') }}"> --}}
                    staff post
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devreq.index') }}"> --}}
                    staff req
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devaid.index') }}"> --}}
                    staff aid
                    </a>
                </h2>
                <h2>
                    {{-- <a href="{{ route('devcategory.index') }}"> --}}
                    staff category
                    </a>
                </h2>
            </td>
        </tbody>
    </table>
</body>

</html>
