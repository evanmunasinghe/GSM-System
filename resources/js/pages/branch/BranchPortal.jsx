import { Link, useForm } from '@inertiajs/react';
import PageStyles from '../../components/PageStyles';
import PublicLayout from '../../components/PublicLayout';

export default function BranchPortal() {
    const { data, setData, post, processing, errors } = useForm({ branch: '' });

    const submit = (event) => {
        event.preventDefault();
        post('/branch-portal', { preserveScroll: true });
    };

    return (
        <PublicLayout>
            <PageStyles title="Branch Portal - FleeV" />

            <main className="branch-wrapper">
                <div className="container">
                    <div className="row min-vh-100 align-items-center justify-content-center">
                        <div className="col-lg-5 col-md-8 col-sm-10">
                            <div className="branch-card">
                                <div className="branch-header text-center">
                                    <div className="logo-box">🏢</div>
                                    <h1>Branch Portal</h1>
                                    <p>Enter your branch code to continue to your branch login page.</p>
                                </div>

                                <form onSubmit={submit}>
                                    <div className="mb-4">
                                        <label htmlFor="branch" className="form-label">
                                            Branch Code
                                        </label>
                                        <input
                                            type="text"
                                            id="branch"
                                            className={`form-control ${errors.branch ? 'is-invalid' : ''}`}
                                            value={data.branch}
                                            onChange={(event) => setData('branch', event.target.value)}
                                            placeholder="Example: davesautos"
                                            required
                                            autoFocus
                                        />
                                        {errors.branch && (
                                            <div className="invalid-feedback">{errors.branch}</div>
                                        )}
                                        <small className="help-text">
                                            Example: enter <strong>davesautos</strong> for
                                            davesautos.localhost
                                        </small>
                                    </div>

                                    <button
                                        type="submit"
                                        className="btn continue-btn w-100"
                                        disabled={processing}
                                    >
                                        {processing ? 'Finding Branch…' : 'Continue to Branch Login'}
                                    </button>
                                </form>

                                <div className="branch-footer text-center">
                                    <Link href="/" prefetch>Back to Home</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </PublicLayout>
    );
}
