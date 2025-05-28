<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" value="{{ old('address', $testimonial->address ?? '') }}">
</div>

<div class="mb-3">
    <label for="message" class="form-label">Message</label>
    <textarea name="message" rows="4" class="form-control" required>{{ old('message', $testimonial->message ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="draft" {{ (old('status', $testimonial->status ?? '') == 'draft') ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ (old('status', $testimonial->status ?? '') == 'published') ? 'selected' : '' }}>Published</option>
    </select>
</div>
