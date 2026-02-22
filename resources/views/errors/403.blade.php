@extends('errors::minimal')

@section('title', __('errorPages.403.title'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'errorPages.403.message'))
@section('text', __('errorPages.403.text'))
