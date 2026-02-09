@extends('layouts.app')

@section('title', 'Welcome - KavyaSetu')

@section('content')
<div class="welcome-container" style="color: white; padding: 60px 20px; text-align: center;">
    <div class="hero-section" style="margin-bottom: 60px;">
        <h1 style="font-size: 4rem; font-weight: 800; margin-bottom: 20px; text-shadow: 0 4px 10px rgba(0,0,0,0.3);">
            📝 KavyaSetu
        </h1>
        <p style="font-size: 1.5rem; opacity: 0.9; max-width: 800px; margin: 0 auto 40px; line-height: 1.6;">
            A bridge connecting poets and poems. Organize your thoughts, manage your verses, and bridge the gap between inspiration and creation.
        </p>
        
        <div style="display: flex; gap: 20px; justify-content: center;">
            <a href="{{ route('register') }}" class="btn btn-success" style="padding: 15px 40px; font-size: 1.2rem; border-radius: 50px; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);">
                Get Started
            </a>
            <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 15px 40px; font-size: 1.2rem; border-radius: 50px; box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);">
                Welcome Back
            </a>
        </div>
    </div>

    <div class="features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 80px;">
        <div class="card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white; border: 1px solid rgba(255,255,255,0.2);">
            <div style="font-size: 3rem; margin-bottom: 20px;">✍️</div>
            <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Capture Inspiration</h3>
            <p style="opacity: 0.8;">Never let a line of poetry slip away. Quickly jot down your thoughts and ideas as they come.</p>
        </div>
        
        <div class="card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white; border: 1px solid rgba(255,255,255,0.2);">
            <div style="font-size: 3rem; margin-bottom: 20px;">📅</div>
            <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Organize Work</h3>
            <p style="opacity: 0.8;">Keep your poems and drafts organized. Manage your poetic journey with easy-to-use task lists.</p>
        </div>
        
        <div class="card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); color: white; border: 1px solid rgba(255,255,255,0.2);">
            <div style="font-size: 3rem; margin-bottom: 20px;">🚀</div>
            <h3 style="font-size: 1.5rem; margin-bottom: 15px;">Stay Productive</h3>
            <p style="opacity: 0.8;">Focus on your creativity while we handle the organization. A simple tool for complex minds.</p>
        </div>
    </div>

    <footer style="margin-top: 100px; opacity: 0.7; font-size: 0.9rem;">
        &copy; {{ date('Y') }} KavyaSetu. All rights reserved.
    </footer>
</div>
@endsection