import { useForm, usePage } from '@inertiajs/react';
import PageStyles from '../../components/PageStyles';
import PublicLayout from '../../components/PublicLayout';

export default function Login({
    title = 'Login',
    subtitle = 'Login to continue to FleeV.',
    formAction = '/login',
    homeUrl = '/',
    credentials = null,
}) {
    const { flash = {} } = usePage().props;
    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (event) => {
        event.preventDefault();
        post(formAction, { preserveScroll: true });
    };

    return (
        <PublicLayout>
            <PageStyles title={`${title} - FleeV`} />

            <main className="login-wrapper">
                <div className="container">
                    <div className="row min-vh-100 align-items-center justify-content-center">
                        <div className="col-lg-5 col-md-8 col-sm-10">
                            <div className="login-card">
                                <div className="login-header text-center">
                                    <div className="logo-box">🔧</div>
                                    <h1>FleeV</h1>
                                    <h2>{title}</h2>
                                    <p>{subtitle}</p>
                                </div>

                                {flash.error && <div className="alert alert-danger">{flash.error}</div>}
                                {flash.success && (
                                    <div className="alert alert-success">{flash.success}</div>
                                )}

                               {/* {credentials && (
                                    <div className="demo-credentials">
                                        <div>
                                            <strong>Demo account</strong>
                                            <span>{credentials.email}</span>
                                            <span>{credentials.password}</span>
                                        </div>
                                        <button
                                            type="button"
                                            onClick={() => {
                                                setData('email', credentials.email);
                                                setData('password', credentials.password);
                                            }}
                                        >
                                            Use credentials
                                        </button>
                                    </div>
                                )}*/}

                                <form onSubmit={submit}>
                                    <div className="mb-3">
                                        <label htmlFor="email" className="form-label">
                                            Email Address
                                        </label>
                                        <input
                                            type="email"
                                            id="email"
                                            className={`form-control ${errors.email ? 'is-invalid' : ''}`}
                                            value={data.email}
                                            onChange={(event) => setData('email', event.target.value)}
                                            placeholder="Enter your email"
                                            required
                                            autoFocus
                                        />
                                        {errors.email && (
                                            <div className="invalid-feedback">{errors.email}</div>
                                        )}
                                    </div>

                                    <div className="mb-3">
                                        <label htmlFor="password" className="form-label">
                                            Password
                                        </label>
                                        <input
                                            type="password"
                                            id="password"
                                            className={`form-control ${errors.password ? 'is-invalid' : ''}`}
                                            value={data.password}
                                            onChange={(event) => setData('password', event.target.value)}
                                            placeholder="Enter your password"
                                            required
                                        />
                                        {errors.password && (
                                            <div className="invalid-feedback">{errors.password}</div>
                                        )}
                                    </div>

                                    <div className="d-flex justify-content-between align-items-center mb-4">
                                        <div className="form-check">
                                            <input
                                                className="form-check-input"
                                                type="checkbox"
                                                id="remember"
                                                checked={data.remember}
                                                onChange={(event) => setData('remember', event.target.checked)}
                                            />
                                            <label className="form-check-label" htmlFor="remember">
                                                Remember me
                                            </label>
                                        </div>
                                        <a
                                            href="#"
                                            className="forgot-link"
                                            onClick={(event) => event.preventDefault()}
                                        >
                                            Forgot password?
                                        </a>
                                    </div>

                                    <button
                                        type="submit"
                                        className="btn login-btn w-100"
                                        disabled={processing}
                                    >
                                        {processing ? 'Logging in…' : 'Login'}
                                    </button>
                                </form>

                                <div className="login-footer text-center">
                                    <a href={homeUrl}>Back to Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </PublicLayout>
    );
}
