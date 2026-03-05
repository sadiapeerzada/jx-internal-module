<?xml version="1.0" encoding="utf-8"?>
<extension type="plugin" group="content" method="upgrade">
    <name>plg_content_autotitleajax</name>
    <author>Your Name</author>
    <version>1.0.0</version>
    <description>
        Content plugin that sets the article title automatically
        via com_ajax when creating a new article.
    </description>

    <files>
        <filename plugin="autotitleajax">autotitleajax.php</filename>
        <folder>services</folder>
        <folder>src</folder>
    </files>

    <config>
        <fields name="params">
            <fieldset name="basic">
                <field
                    name="default_text"
                    type="text"
                    label="Default Title Text"
                    description="Text used to prefill the article title"
                    default="Sample Article Title"
                />
            </fieldset>
        </fields>
    </config>
</extension>
